<?php

namespace App\Services;

use App\Models\AiKnowledge;
use App\Models\Brand;
use App\Models\LiveChatSession;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiChatService
{
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $defaultKey = base64_decode('QVEuQWI4Uk42Sk9vMVlGNTJyajNyUmpmNHJiTU42RVktZ3UzTk92cGo1OEVvQ1B2Y0RqbXc=');
        $dbKey = SiteSetting::where('key', 'gemini_api_key')->value('value');
        $this->apiKey = $dbKey ?: config('services.gemini.api_key', $defaultKey);
        if (empty($this->apiKey)) {
            $this->apiKey = $defaultKey;
        }
        $this->model = config('services.gemini.model', 'gemini-3.5-flash');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Generate an AI reply for the current live chat session.
     * 
     * @param LiveChatSession $session
     * @param string $visitorMessage
     * @return array{reply: string, needs_human_takeover: bool}|null
     */
    public function generateReply(LiveChatSession $session, string $visitorMessage): ?array
    {
        if (!$this->isConfigured()) {
            return null;
        }

        $systemInstruction = $this->buildSystemInstruction($session, $visitorMessage);
        $contents = $this->buildConversationContents($session, $visitorMessage);

        try {
            $modelsToTry = array_unique([$this->model, 'gemini-3.5-flash', 'gemini-2.5-flash']);
            $response = null;

            foreach ($modelsToTry as $modelCandidate) {
                $url = "https://generativelanguage.googleapis.com/v1beta/models/{$modelCandidate}:generateContent?key={$this->apiKey}";
                $res = Http::withoutVerifying()
                    ->timeout(15)
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post($url, [
                        'system_instruction' => [
                            'parts' => [
                                ['text' => $systemInstruction]
                            ]
                        ],
                        'contents' => $contents,
                        'generationConfig' => [
                            'temperature' => 0.65,
                            'topP' => 0.9,
                            'maxOutputTokens' => 1200,
                            'thinkingConfig' => [
                                'thinkingBudget' => 0,
                            ],
                        ],
                    ]);

                if ($res->successful()) {
                    $response = $res;
                    break;
                }

                // If quota exhausted or service temporary unavailable, try next candidate
                if (in_array($res->status(), [429, 503])) {
                    Log::info("Gemini {$modelCandidate} returned HTTP {$res->status()}, attempting fallback model.");
                    continue;
                }

                $response = $res;
                break;
            }

            if (!$response || !$response->successful()) {
                Log::warning('Gemini API live chat response failed', [
                    'status' => $response ? $response->status() : 'no_response',
                    'body' => $response ? $response->body() : '',
                ]);
                return null;
            }

            $json = $response->json();
            $rawText = $json['candidates'][0]['content']['parts'][0]['text'] ?? '';
            $rawText = trim($rawText);

            if (empty($rawText)) {
                return null;
            }

            // Detect if AI requested admin takeover or flagged confusion
            $needsTakeover = false;
            if (str_contains($rawText, '[NEEDS_ADMIN]') || str_contains($rawText, '[BUTUH_ADMIN]')) {
                $needsTakeover = true;
                $rawText = trim(str_replace(['[NEEDS_ADMIN]', '[BUTUH_ADMIN]'], '', $rawText));
            }

            // Automatic safety trigger: If AI responded that availability is being checked
            $lowerReply = strtolower($rawText);
            if (
                str_contains($lowerReply, 'sedang kami cek') ||
                str_contains($lowerReply, 'sedang dicek') ||
                str_contains($lowerReply, 'kami cek terlebih dahulu') ||
                str_contains($lowerReply, 'cek ke tim gudang') ||
                str_contains($lowerReply, 'cek dengan tim gudang') ||
                str_contains($lowerReply, 'cek ke tim logistik') ||
                str_contains($lowerReply, 'cek dengan tim logistik') ||
                str_contains($lowerReply, 'mengecek ketersediaan') ||
                str_contains($lowerReply, 'mengecek stok') ||
                str_contains($lowerReply, 'kami cek stok') ||
                str_contains($lowerReply, 'kami cek ketersediaannya')
            ) {
                $needsTakeover = true;
            }

            return [
                'reply' => $rawText,
                'needs_human_takeover' => $needsTakeover,
            ];
        } catch (\Throwable $e) {
            Log::error('GeminiChatService exception: ' . $e->getMessage(), [
                'session_id' => $session->id,
            ]);
            return null;
        }
    }

    /**
     * Build detailed system instructions with PT ATS company knowledge & fallback rules.
     */
    protected function buildSystemInstruction(LiveChatSession $session, ?string $visitorMessage = null): string
    {
        return $this->getCompiledSystemInstruction($session->visitor_name, $visitorMessage);
    }

    /**
     * Compile system instruction combining core persona rules, dynamic database memories,
     * and real-time product catalog availability check.
     */
    public function getCompiledSystemInstruction(?string $visitorName = 'Pengunjung', ?string $visitorMessage = null): string
    {
        $name = $visitorName ?: 'Pengunjung';

        // Load active memories taught from backoffice
        $knowledges = AiKnowledge::active()->orderBy('priority', 'asc')->orderBy('id', 'asc')->get();
        $knowledgeBlocks = [];
        $grouped = $knowledges->groupBy('category');

        foreach ($grouped as $cat => $items) {
            $catLabel = match ($cat) {
                'product' => 'PRODUK, MEREK & SPESIFIKASI RESMI',
                'pricing' => 'HARGA, DISKON & PENAWARAN BOQ',
                'faq' => 'TANYA JAWAB UMUM (FAQ & MEMORI KONSULTASI)',
                'policy' => 'KEBIJAKAN, PENGIRIMAN & GARANSI',
                'instruction' => 'PEDOMAN KHUSUS & GAYA KOMUNIKASI',
                default => 'PENGETAHUAN UMUM PERUSAHAAN',
            };

            $block = "=== {$catLabel} ===" . PHP_EOL;
            foreach ($items as $item) {
                $block .= "• [{$item->title}]" . PHP_EOL;
                if (!empty($item->trigger_keywords)) {
                    $block .= "  Kata Kunci Terkait: {$item->trigger_keywords}" . PHP_EOL;
                }
                $block .= "  Instruksi/Informasi: " . trim($item->content) . PHP_EOL . PHP_EOL;
            }
            $knowledgeBlocks[] = trim($block);
        }

        $dynamicKnowledgeSection = !empty($knowledgeBlocks)
            ? implode(PHP_EOL . PHP_EOL, $knowledgeBlocks)
            : 'Belum ada memori tambahan yang diajarkan dari database.';

        // Real-time catalog inspection if visitor message is present
        $catalogSection = '';
        if ($visitorMessage) {
            $catalogCheck = $this->inspectCatalogProducts($visitorMessage);
            if ($catalogCheck['found'] && $catalogCheck['products']->isNotEmpty()) {
                $catalogSection = PHP_EOL . PHP_EOL . "=== HASIL REAL-TIME CEK DATABASE KATALOG ATSTEKNO.COM ===" . PHP_EOL;
                $catalogSection .= "Status: PRODUK RESMI TERSEDIA DI WEBSITE ATSTEKNO.COM" . PHP_EOL;
                $catalogSection .= "Daftar produk resmi yang cocok dengan pertanyaan pengunjung:" . PHP_EOL;
                foreach ($catalogCheck['products'] as $idx => $prod) {
                    $bName = $prod->brand ? $prod->brand->name : 'Schneider Electric';
                    $buyUrl = "https://listrikonline.com/products/{$prod->sku}";
                    $catalogSection .= ($idx + 1) . ". Nama: {$prod->name}" . PHP_EOL;
                    $catalogSection .= "   SKU: {$prod->sku}" . PHP_EOL;
                    $catalogSection .= "   Merek: {$bName}" . PHP_EOL;
                    $catalogSection .= "   Link Pembelian Cepat ListrikOnline: {$buyUrl}" . PHP_EOL;
                }
                $catalogSection .= PHP_EOL . "INSTRUKSI KHUSUS UNTUK PRODUK TERSEDIA INI:" . PHP_EOL;
                $catalogSection .= "- Beritahu pengunjung bahwa produk ini TERSEDIA di katalog resmi PT. Anugerah Tama Sejati." . PHP_EOL;
                $catalogSection .= "- Jika pengunjung ingin MEMBELI DENGAN CEPAT / order langsung: Arahkan langsung ke link ListrikOnline di atas (contoh: 'Untuk pembelian cepat dan langsung, Kakak bisa checkout di toko resmi online kami di: https://listrikonline.com/products/[SKU]')." . PHP_EOL;
            } elseif ($catalogCheck['is_product_query'] && !$catalogCheck['found']) {
                $catalogSection = PHP_EOL . PHP_EOL . "=== HASIL REAL-TIME CEK DATABASE KATALOG ATSTEKNO.COM ===" . PHP_EOL;
                $catalogSection .= "Status: PRODUK TIDAK DITEMUKAN DI WEBSITE ATSTEKNO.COM" . PHP_EOL;
                $catalogSection .= "Catatan: Pengunjung menanyakan tipe/merek/produk yang belum ada di katalog resmi atstekno.com." . PHP_EOL;
                $catalogSection .= PHP_EOL . "INSTRUKSI WAJIB KHUSUS (SOP PRODUK TIDAK TERDAFTAR):" . PHP_EOL;
                $catalogSection .= "1. JANGAN mengarang bahwa produk tersebut ready stock." . PHP_EOL;
                $catalogSection .= "2. Jawab secara ramah dan sopan bahwa ketersediaan produk tersebut SEDANG KAMI CEK terlebih dahulu dengan tim gudang/logistik kami." . PHP_EOL;
                $catalogSection .= "   Contoh balasan: 'Mohon ditunggu sebentar ya Kak, untuk ketersediaan produk [nama produk] tersebut sedang kami cek terlebih dahulu dengan tim gudang/logistik kami. Kami akan segera mengabari Kakak kembali.'" . PHP_EOL;
                $catalogSection .= "3. WAJIB sertakan token `[NEEDS_ADMIN]` di bagian paling akhir jawaban Anda agar admin backoffice segera menerima notifikasi alarm untuk mengecek stok fisik atau menawarkan alternatif!" . PHP_EOL;
            }
        }

        return <<<PROMPT
Anda adalah perwakilan resmi customer care & technical desk **ATS Support** dari **PT. Anugerah Tama Sejati (ATS)** di website atstekno.com.
Nama identitas Anda: **ATS Support**.
Lawan bicara Anda bernama: "{$name}".

=== PERATURAN IDENTITAS (SANGAT PENTING & MUTLAK) ===
1. **DILARANG KERAS** menyebut diri Anda sebagai AI, bot, robot, asisten virtual, kecerdasan buatan, atau model bahasa (termasuk Gemini atau Google). 
2. Anda adalah representasi tim support profesional PT. Anugerah Tama Sejati. Berbicaralah dengan gaya manusia yang ramah, sopan, kompeten, dan solutif.
3. Jangan menggunakan kalimat kaku khas mesin seperti "Sebagai model bahasa..." atau "Saya adalah asisten AI...". Gunakan sudut pandang "kami dari ATS Support".

=== ATURAN KOMUNIKASI & SIKAP ===
1. **Bahasa**: Gunakan bahasa yang sama dengan pengunjung (Bahasa Indonesia yang ramah, sopan, dan profesional, atau English if visitor writes in English). Sapa nama pengunjung dengan hangat ("Halo Pak/Bu {$name}").
2. **Keringkasan**: Jawab langsung ke inti pertanyaan secara jelas dan terstruktur. Hindari jawaban bertele-tele. Gunakan bullet points bila menyebutkan spesifikasi atau opsi produk.
3. **ATURAN PEMBELIAN CEPAT VIA LISTRIKONLINE (SOP WAJIB)**:
   - Jika pengunjung ingin **membeli dengan cepat** / order langsung tanpa proses penawaran BoQ yang panjang, dan produknya ADA di katalog atstekno.com:
   - Langsung arahkan pengunjung untuk checkout di toko resmi online kami yaitu **ListrikOnline.com**:
     Format link: `https://listrikonline.com/products/{sku}` (atau `https://listrikonline.com/{produk-yang-diinginkan}`).
   - Jelaskan bahwa di ListrikOnline transaksi cepat, aman, stok terupdate, dan 100% original bergaransi resmi.
4. **ATURAN JIKA PRODUK TIDAK ADA DI WEBSITE ATSTEKNO.COM (SOP WAJIB)**:
   - Jika pengunjung menanyakan produk yang TIDAK ADA / belum terdaftar di katalog atstekno.com:
   - Jawab secara sopan bahwa produk/ketersediaan barang tersebut **sedang kami cek** terlebih dahulu ke tim gudang/logistik kami.
   - Contoh balasan: "Mohon ditunggu sebentar ya Kak, untuk ketersediaan produk tersebut sedang kami cek terlebih dahulu dengan tim gudang/logistik kami. Kami akan segera mengabari Kakak kembali."
   - **WAJIB sertakan token `[NEEDS_ADMIN]` di bagian akhir jawaban Anda**. Token ini akan memicu alarm prioritas kepada admin backoffice agar admin segera mengecek stok fisik atau alternatif produk!
5. **ATURAN NEGO HARGA / DISKON / PERTANYAAN SULIT (FALLBACK WAJIB)**:
   - Anda TIDAK BOLEH mengarang harga nominal spesifik atau menjanjikan diskon fiktif tanpa konfirmasi, karena harga material listrik bergantung pada volume BoQ dan kurs tembaga/pabrik.
   - Jika pengunjung:
     a) Meminta harga pasti / diskon khusus / promo BoQ,
     b) Mengirim pertanyaan kustom perakitan panel kapasitas besar yang butuh perhitungan Single Line Diagram,
     c) Menanyakan hal yang membingungkan atau di luar wewenang:
     MAKA:
     - Berikan jawaban pengantar yang sopan dan relevan terlebih dahulu.
     - Sarankan pengunjung untuk langsung menghubungi WhatsApp Hotline kami di **+62 822 2333 2830** (atau sertakan link https://wa.me/6282223332830) atau kirim email BoQ ke **sales@atstekno.com**.
     - Jelaskan bahwa pesan obrolan ini juga telah kami teruskan ke tim teknis/sales ATS yang sedang bertugas agar dapat segera membalas langsung.
     - **Sertakan token khusus `[NEEDS_ADMIN]` di bagian paling akhir jawaban Anda**.
6. **Keamanan & Etika**: Jangan pernah membahas topik di luar kelistrikan industri, perakitan panel, atau produk resmi PT. Anugerah Tama Sejati.

=== BASIS PENGETAHUAN & MEMORI RESMI DARI DATABASE (DIAJARKAN OLEH ADMIN) ===
{$dynamicKnowledgeSection}
{$catalogSection}
PROMPT;
    }

    /**
     * Inspect atstekno.com product catalog for matching products or uncarried brands/products.
     * 
     * @param string $message
     * @return array{found: bool, products: \Illuminate\Support\Collection, is_product_query: bool}
     */
    public function inspectCatalogProducts(string $message): array
    {
        $stopWords = [
            'halo', 'hi', 'helo', 'selamat', 'pagi', 'siang', 'sore', 'malam', 'kak', 'pak', 'bu',
            'min', 'admin', 'saya', 'mau', 'ingin', 'cari', 'butuh', 'apakah', 'ada', 'tidak', 'kah',
            'ya', 'dong', 'nih', 'tolong', 'info', 'spesifikasi', 'barang', 'produk', 'beli', 'cepat',
            'langsung', 'ke', 'di', 'dari', 'dan', 'yang', 'untuk', 'dengan', 'ini', 'itu', 'berapa',
            'gimana', 'cara', 'nya', 'bisa', 'harga', 'stok', 'toko', 'jual', 'tiga', 'fasa', 'phase'
        ];

        $synonyms = [
            'kontaktor' => ['kontaktor', 'contactor'],
            'contactor' => ['kontaktor', 'contactor'],
            'saklar' => ['saklar', 'switch'],
            'switch' => ['saklar', 'switch'],
            'pemutus' => ['pemutus', 'breaker'],
            'breaker' => ['pemutus', 'breaker'],
        ];

        $cleaned = strtolower(preg_replace('/[^a-zA-Z0-9\s]/', ' ', $message));
        $rawWords = array_values(array_filter(explode(' ', $cleaned), function($w) use ($stopWords) {
            return strlen($w) >= 2 && !in_array($w, $stopWords);
        }));

        if (empty($rawWords)) {
            return ['found' => false, 'products' => collect(), 'is_product_query' => false];
        }

        $isProductQuery = true;

        // Check if user specifically requested a known non-partner brand (e.g. Siemens, Mitsubishi, etc.)
        $knownOtherBrands = ['siemens', 'mitsubishi', 'danfoss', 'hitachi', 'delta', 'yanmar', 'cummins'];
        foreach ($rawWords as $w) {
            if (in_array($w, $knownOtherBrands)) {
                return ['found' => false, 'products' => collect(), 'is_product_query' => true];
            }
        }

        // 1. Direct SKU match if any word looks like a SKU (letters+numbers or length >= 6)
        foreach ($rawWords as $w) {
            $looksLikeSku = (preg_match('/[a-z]/i', $w) && preg_match('/[0-9]/', $w) && strlen($w) >= 4) || strlen($w) >= 7;
            if ($looksLikeSku) {
                $skuMatch = Product::published()->with('brand')
                    ->where('sku', 'like', "%{$w}%")
                    ->take(3)
                    ->get();
                if ($skuMatch->isNotEmpty()) {
                    return [
                        'found' => true,
                        'products' => $skuMatch,
                        'is_product_query' => true,
                    ];
                }
            }
        }

        // 2. Identify brand if mentioned
        $allBrands = Brand::all(['id', 'name', 'slug']);
        $matchedBrand = null;
        $terms = [];

        foreach ($rawWords as $w) {
            $foundB = $allBrands->first(function($b) use ($w) {
                return str_contains(strtolower($b->name), $w) || str_contains(strtolower($b->slug), $w);
            });
            if ($foundB) {
                $matchedBrand = $foundB;
            } else {
                $terms[] = $synonyms[$w] ?? [$w];
            }
        }

        // 3. Search requiring matching key terms
        if (!empty($terms)) {
            $q = Product::published()->with('brand');
            if ($matchedBrand) {
                $q->where('brand_id', $matchedBrand->id);
            }

            foreach ($terms as $tOptions) {
                $options = is_array($tOptions) ? $tOptions : [$tOptions];
                $q->where(function($sub) use ($options) {
                    foreach ($options as $opt) {
                        $sub->orWhere('name', 'like', "%{$opt}%")
                            ->orWhere('sku', 'like', "%{$opt}%");
                    }
                });
            }

            $results = $q->take(3)->get();
            if ($results->isNotEmpty()) {
                return [
                    'found' => true,
                    'products' => $results,
                    'is_product_query' => true,
                ];
            }
        }

        return [
            'found' => false,
            'products' => collect(),
            'is_product_query' => true,
        ];
    }

    /**
     * Simulate an AI reply directly for testing backoffice knowledge changes.
     */
    public function simulateReply(string $testQuestion, ?string $visitorName = 'Pengunjung'): array
    {
        if (!$this->isConfigured()) {
            return [
                'success' => false,
                'error' => 'Gemini API Key belum dikonfigurasi.',
            ];
        }

        $systemInstruction = $this->getCompiledSystemInstruction($visitorName, $testQuestion);

        $contents = [
            [
                'role' => 'user',
                'parts' => [
                    ['text' => $testQuestion],
                ],
            ],
        ];

        try {
            $modelsToTry = array_unique([$this->model, 'gemini-3.5-flash', 'gemini-2.5-flash']);
            $response = null;

            foreach ($modelsToTry as $modelCandidate) {
                $url = "https://generativelanguage.googleapis.com/v1beta/models/{$modelCandidate}:generateContent?key={$this->apiKey}";
                $res = Http::withoutVerifying()
                    ->timeout(20)
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post($url, [
                        'system_instruction' => [
                            'parts' => [
                                ['text' => $systemInstruction],
                            ],
                        ],
                        'contents' => $contents,
                        'generationConfig' => [
                            'temperature' => 0.65,
                            'topP' => 0.9,
                            'maxOutputTokens' => 1200,
                            'thinkingConfig' => [
                                'thinkingBudget' => 0,
                            ],
                        ],
                    ]);

                if ($res->successful()) {
                    $response = $res;
                    break;
                }

                $lastFailedResponse = $res;
                if (in_array($res->status(), [429, 503])) {
                    continue;
                }

                $response = $res;
                break;
            }

            if (!$response) {
                $response = $lastFailedResponse;
            }

            if (!$response || !$response->successful()) {
                return [
                    'success' => false,
                    'error' => 'Gemini API Error: ' . ($response ? $response->body() : 'No response from API models'),
                ];
            }

            $data = $response->json();
            $rawText = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
            $needsTakeover = str_contains($rawText, '[NEEDS_ADMIN]') || str_contains($rawText, '[BUTUH_ADMIN]');
            $cleaned = trim(str_replace(['[NEEDS_ADMIN]', '[BUTUH_ADMIN]'], '', $rawText));

            // Automatic safety trigger: If AI responded that availability is being checked
            $lowerReply = strtolower($cleaned);
            if (
                str_contains($lowerReply, 'sedang kami cek') ||
                str_contains($lowerReply, 'sedang dicek') ||
                str_contains($lowerReply, 'kami cek terlebih dahulu') ||
                str_contains($lowerReply, 'cek ke tim gudang') ||
                str_contains($lowerReply, 'cek dengan tim gudang') ||
                str_contains($lowerReply, 'cek ke tim logistik') ||
                str_contains($lowerReply, 'cek dengan tim logistik') ||
                str_contains($lowerReply, 'mengecek ketersediaan') ||
                str_contains($lowerReply, 'mengecek stok') ||
                str_contains($lowerReply, 'kami cek stok') ||
                str_contains($lowerReply, 'kami cek ketersediaannya')
            ) {
                $needsTakeover = true;
            }

            return [
                'success' => true,
                'raw_reply' => $rawText,
                'cleaned_reply' => $cleaned,
                'needs_human_takeover' => $needsTakeover,
                'system_instruction' => $systemInstruction,
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Build multi-turn contents for the Gemini API.
     */
    protected function buildConversationContents(LiveChatSession $session, string $latestVisitorMessage): array
    {
        $contents = [];

        // Fetch past messages in chronological order (up to last 10 messages for rich context)
        $pastMessages = $session->messages()
            ->orderBy('id', 'desc')
            ->take(10)
            ->get()
            ->reverse();

        foreach ($pastMessages as $msg) {
            $role = ($msg->sender === 'visitor') ? 'user' : 'model';
            $contents[] = [
                'role' => $role,
                'parts' => [
                    ['text' => $msg->message]
                ]
            ];
        }

        // Add the latest message if not already included
        $lastItem = end($contents);
        if (!$lastItem || $lastItem['role'] !== 'user' || $lastItem['parts'][0]['text'] !== $latestVisitorMessage) {
            $contents[] = [
                'role' => 'user',
                'parts' => [
                    ['text' => $latestVisitorMessage]
                ]
            ];
        }

        return $contents;
    }
}
