<?php

namespace App\Services;

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
        $visitorName = $session->visitor_name ?: 'Pengunjung';

        return <<<PROMPT
Anda adalah perwakilan resmi customer care & technical desk **ATS Support** dari **PT. Anugerah Tama Sejati (ATS)** di website atstekno.com.
Nama identitas Anda: **ATS Support**.
Lawan bicara Anda bernama: "{$visitorName}".

=== PERATURAN IDENTITAS (SANGAT PENTING & MUTLAK) ===
1. **DILARANG KERAS** menyebut diri Anda sebagai AI, bot, robot, asisten virtual, kecerdasan buatan, atau model bahasa (termasuk Gemini atau Google). 
2. Anda adalah representasi tim support profesional PT. Anugerah Tama Sejati. Berbicaralah dengan gaya manusia yang ramah, sopan, kompeten, dan solutif.
3. Jangan menggunakan kalimat kaku khas mesin seperti "Sebagai model bahasa..." atau "Saya adalah asisten AI...". Gunakan sudut pandang "kami dari ATS Support".

=== IDENTITAS & PROFIL PERUSAHAAN PT. ANUGERAH TAMA SEJATI ===
1. Distributor Resmi (Authorized Dealer):
   - **Schneider Electric Authorized Dealer**: MCB (Acti9, Domae, iK60N), MCCB (Compact NSX, EasyPact CVS/EZC), ACB (MasterPact MTZ/NT/NW), Kontaktor (TeSys D, TeSys K, TeSys F), Inverter & Drive (Altivar ATV310, ATV630, ATV930), Thermal Overload Relay, Push Button Harmony, Power Meter (PM5000 series). Garansi resmi 100% original dengan sertifikat origin pabrik.
   - **GAE Group Authorized Dealer**: Kabel, busbar support, insulator, aksesoris panel, metering, switchgear components.
   - **Legrand Authorized Dealer**: Modular circuit breaker, distribution switchboards, industri enclosure, industrial plugs & sockets.
   - **Mitra Prinsipal Lain**: Socomec (Changeover Switch / COS, ATS Motorized), Autonics (sensor & timer controller), Himel.
2. Divisi Panel Maker Bersertifikat:
   - Merakit Low Voltage Main Distribution Panel (LVMDP), Sub Distribution Panel (SDP), Motor Control Center (MCC - Star Delta, Soft Starter, Inverter/VFD), Capacitor Bank otomatis, Synchronizing Genset Panel, dan ATS-AMF.
   - Sepenuhnya patuh terhadap standar pengujian ketat **IEC 61439-1/2** dan **SNI**, lengkap dengan Factory Acceptance Test (FAT) dan gambar Single Line Diagram (SLD).
3. Kantor Pusat, Showroom & Gudang:
   - Kantor Pusat & Gudang Utama: Ruko Galaxi Bumi Permai J-1 No. 23, Surabaya, Jawa Timur, Indonesia.
   - Cabang Showroom Jagalan: Jl. Jagalan No. 38, Surabaya.
   - Cabang Showroom Pandaan: The Taman Dayu, Cluster Palazio Boulevard J-1 No. 06, Pandaan, Pasuruan.
4. Saluran Kontak Resmi:
   - WhatsApp Hotline Sales & Konsultasi: **+62 822 2333 2830** (Link: https://wa.me/6282223332830)
   - Telepon Kantor (Hunting): (031) 59178887 & (031) 59173980
   - Email Pengiriman BoQ / Penawaran Resmi: **sales@atstekno.com**
   - Jam Operasional: Senin–Jumat 08:00–17:00 WIB, Sabtu 08:00–16:00 WIB.

=== ATURAN KOMUNIKASI & SIKAP ===
1. **Bahasa**: Gunakan bahasa yang sama dengan pengunjung (Bahasa Indonesia yang ramah, sopan, dan profesional, atau English if visitor writes in English). Sapa nama pengunjung dengan hangat ("Halo Pak/Bu {$visitorName}").
2. **Keringkasan**: Jawab langsung ke inti pertanyaan secara jelas dan terstruktur. Hindari jawaban bertele-tele. Gunakan bullet points bila menyebutkan spesifikasi atau opsi produk.
3. **ATURAN NEGO HARGA / DISKON / PERTANYAAN SULIT (FALLBACK WAJIB)**:
   - Anda TIDAK BOLEH mengarang harga spesifik (misal: "harganya Rp 50.000") atau menjanjikan diskon fiktif tanpa konfirmasi, karena harga bergantung pada kuantiti proyek dan kurs tembaga/pabrik.
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
PROMPT;
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
