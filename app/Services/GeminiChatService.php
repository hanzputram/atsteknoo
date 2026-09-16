<?php

namespace App\Services;

use App\Models\AiKnowledge;
use App\Models\LiveChatSession;
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
        $this->model = config('services.gemini.model', 'gemini-2.5-flash');
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

        $systemInstruction = $this->buildSystemInstruction($session);
        $contents = $this->buildConversationContents($session, $visitorMessage);

        try {
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}";

            $response = Http::withoutVerifying()
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
                        'maxOutputTokens' => 800,
                    ],
                ]);

            if (!$response->successful()) {
                Log::warning('Gemini API live chat response failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
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
    protected function buildSystemInstruction(LiveChatSession $session): string
    {
        return $this->getCompiledSystemInstruction($session->visitor_name);
    }

    /**
     * Compile system instruction combining core persona rules and dynamic database memories.
     */
    public function getCompiledSystemInstruction(?string $visitorName = 'Pengunjung'): string
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
3. **ATURAN NEGO HARGA / DISKON / PERTANYAAN SULIT (FALLBACK WAJIB)**:
   - Anda TIDAK BOLEH mengarang harga nominal spesifik atau menjanjikan diskon fiktif tanpa konfirmasi, karena harga material listrik bergantung pada volume BoQ dan kurs tembaga/pabrik.
   - Jika pengunjung:
     a) Meminta harga pasti / diskon khusus / promo BoQ,
     b) Mengirim pertanyaan kustom perakitan panel kapasitas besar yang butuh perhitungan Single Line Diagram,
     c) Menanyakan hal yang membingungkan atau di luar wewenang:
     MAKA:
     - Berikan jawaban pengantar yang sopan dan relevan terlebih dahulu.
     - Sarankan pengunjung untuk langsung menghubungi WhatsApp Hotline kami di **+62 822 2333 2830** (atau sertakan link https://wa.me/6282223332830) atau kirim email BoQ ke **sales@atstekno.com**.
     - Jelaskan bahwa pesan obrolan ini juga telah kami teruskan ke tim teknis/sales ATS yang sedang bertugas agar dapat segera membalas langsung.
     - **Sertakan token khusus `[NEEDS_ADMIN]` di bagian paling akhir jawaban Anda**. Token ini akan dideteksi oleh sistem untuk memicu alarm prioritas kepada admin kami!
4. **Keamanan & Etika**: Jangan pernah membahas topik di luar kelistrikan industri, perakitan panel, atau produk resmi PT. Anugerah Tama Sejati.

=== BASIS PENGETAHUAN & MEMORI RESMI DARI DATABASE (DIAJARKAN OLEH ADMIN) ===
{$dynamicKnowledgeSection}
PROMPT;
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

        $systemInstruction = $this->getCompiledSystemInstruction($visitorName);

        $contents = [
            [
                'role' => 'user',
                'parts' => [
                    ['text' => $testQuestion],
                ],
            ],
        ];

        try {
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent?key={$this->apiKey}";

            $response = Http::withoutVerifying()
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
                        'maxOutputTokens' => 800,
                    ],
                ]);

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => 'Gemini API Error: ' . $response->body(),
                ];
            }

            $data = $response->json();
            $rawText = $data['candidates'][0]['content']['parts'][0]['text'] ?? '';
            $needsTakeover = str_contains($rawText, '[NEEDS_ADMIN]') || str_contains($rawText, '[BUTUH_ADMIN]');
            $cleaned = trim(str_replace(['[NEEDS_ADMIN]', '[BUTUH_ADMIN]'], '', $rawText));

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
