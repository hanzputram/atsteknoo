<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CurateArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:curate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean and curate all articles: author ATS Engineering Team, responsive photo figures/captions, remove WP artifacts, and assign technical tags';

    /**
     * Engineering taxonomy dictionary for smart auto-tagging.
     */
    protected array $tagRules = [
        'Schneider Electric' => [
            'schneider', 'schneider electric', 'tesys', 'acti9', 'easy9', 'domae', 'micrologic', 'masterpact', 'compact nsb', 'powerpact', 'altivar', 'ats48'
        ],
        'Circuit Breaker' => [
            'breaker', 'pemutus sirkuit', 'pemutus arus', 'mcb', 'mccb', 'acb', 'rccb', 'rcbo', 'elcb', 'trip', 'hubung singkat', 'overload'
        ],
        'RCCB' => [
            'rccb', 'residual current circuit breaker', 'arus sisa', 'kebocoran arus', 'sentuhan langsung'
        ],
        'RCBO' => [
            'rcbo', 'residual current breaker with overcurrent', 'arus lebih'
        ],
        'MCB' => [
            'mcb', 'miniature circuit breaker', 'miniatur circuit breaker', 'daya rumah'
        ],
        'MCCB' => [
            'mccb', 'moulded case circuit breaker', 'molded case'
        ],
        'Air Circuit Breaker (ACB)' => [
            'acb', 'air circuit breaker', 'pemutus udara', 'gardu trafo'
        ],
        'Panel Listrik' => [
            'panel listrik', 'switchboard', 'cubicle', 'box panel', 'panel distribusi', 'lvmdp', 'mdp', 'sdp'
        ],
        'Automatic Transfer Switch (ATS)' => [
            'automatic transfer switch', 'panel ats', 'ats amf', 'transfer switch', 'genset', 'change over switch', 'cos', 'pemindahan daya'
        ],
        'UPS & Power Backup' => [
            'ups', 'uninterruptible power supply', 'daya cadangan', 'baterai cadangan', 'power supply', 'mati listrik'
        ],
        'Surge Protection Device (SPD)' => [
            'surge', 'spd', 'petir', 'proteksi petir', 'lonjakan tegangan', 'transient'
        ],
        'Inverter & Motor Control' => [
            'inverter', 'vfd', 'variable frequency drive', 'soft starter', 'softstart', 'motor listrik', 'pengasutan motor', 'ats48'
        ],
        'Kontaktor & Relay' => [
            'kontaktor', 'contactor', 'relay', 'tdr', 'time delay relay', 'thermal overload', 'tor', 'magnetic contactor'
        ],
        'Kabel & Aksesoris Busbar' => [
            'kabel', 'jembo', 'supreme', 'penghantar', 'konduktor', 'busbar', 'skun', 'terminasi'
        ],
        'Standar PUIL & Keselamatan' => [
            'puil', 'iec', 'keselamatan listrik', 'bahaya listrik', 'sengatan listrik', 'grounding', 'pembumian', 'isolasi', 'proteksi'
        ],
        'Distribusi Daya Industri' => [
            'distribusi daya', 'tegangan rendah', 'trafo', 'transformator', '3 fasa', '1 fasa', 'beban listrik', 'kapasitor bank'
        ],
        'Otomasi & Sensor Industri' => [
            'limit switch', 'sensor', 'otomasi', 'plc', 'push button', 'pilot lamp', 'saklar', 'switch'
        ],
    ];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info("=== Memulai Kurasi Komprehensif Artikel ATS Tekno ===");

        // 1. Siapkan semua master Tag di database
        $tagModels = [];
        foreach (array_keys($this->tagRules) as $tagName) {
            $slug = Str::slug($tagName);
            $tag = Tag::firstOrCreate(
                ['slug' => $slug],
                ['name' => $tagName, 'is_active' => true]
            );
            $tagModels[$tagName] = $tag->id;
        }

        $articles = Article::all();
        $total = $articles->count();
        $this->info("Memproses {$total} artikel...");

        $this->output->progressStart($total);

        foreach ($articles as $article) {
            // A. Update Author ke ATS Engineering Team
            $article->author_display_name = 'ATS Engineering Team';

            // B. Kurasi & Pembersihan HTML Konten
            $content = $article->content_html ?? '';
            $cleanedContent = $this->curateContentHtml($article->title, $content);
            $article->content_html = $cleanedContent;

            // C. Perbaiki Excerpt jika terlalu kotor atau ada sisa shortcode
            if (empty($article->excerpt) || str_contains($article->excerpt, '[') || str_contains($article->excerpt, 'Diri merasa rendah')) {
                $plain = strip_tags($cleanedContent);
                $plain = preg_replace('/\s+/', ' ', $plain);
                $article->excerpt = Str::limit(trim($plain), 160);
            }

            // D. Smart Tagging
            $matchedTagIds = $this->extractMatchingTags($article->title, $article->slug, $cleanedContent, $tagModels);
            
            // Simpan perubahan artikel
            $article->save();

            // Kaitkan tags (selalu berikan minimal 2-5 tag yang relevan)
            if (!empty($matchedTagIds)) {
                $article->tags()->sync($matchedTagIds);
            }

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
        $this->info("✓ Berhasil mengurasi {$total} artikel!");
        $this->info("✓ Penulis semua artikel distandardisasi menjadi 'ATS Engineering Team'");
        $this->info("✓ Shortcode WordPress [caption] diubah menjadi figure semantik responsif");
        $this->info("✓ Tag kelistrikan telah dikaitkan secara cerdas");

        return Command::SUCCESS;
    }

    /**
     * Curate and polish article content HTML.
     */
    protected function curateContentHtml(string $title, string $html): string
    {
        // 1. Ubah shortcode [caption id="..." align="..." width="..."]<a ...><img ...></a> Teks Caption[/caption]
        $html = preg_replace_callback('/\[caption[^\]]*\](.*?)\[\/caption\]/is', function ($matches) {
            $inner = trim($matches[1]);
            
            // Ekstrak tag img/link dan teks caption setelahnya
            $imgHtml = '';
            $captionText = '';

            if (preg_match('/(<a\b[^>]*>)?\s*(<img\b[^>]*>)\s*(<\/a>)?/is', $inner, $imgMatch)) {
                $imgHtml = $imgMatch[0];
                $captionText = trim(str_replace($imgHtml, '', $inner));
            } else {
                $imgHtml = $inner;
            }

            // Bersihkan styling inline dari imgHtml agar responsif dan berbingkai elegan
            $imgHtml = preg_replace('/\bwidth=["\']\d+["\']/i', '', $imgHtml);
            $imgHtml = preg_replace('/\bheight=["\']\d+["\']/i', '', $imgHtml);
            $imgHtml = preg_replace('/\bclass=["\']([^"\']*)["\']/i', 'class="$1 max-w-full h-auto mx-auto rounded-xl object-contain shadow-xs transition duration-300 hover:scale-[1.02]"', $imgHtml);

            if (!str_contains($imgHtml, 'class=')) {
                $imgHtml = str_replace('<img ', '<img class="max-w-full h-auto mx-auto rounded-xl object-contain shadow-xs transition duration-300 hover:scale-[1.02]" ', $imgHtml);
            }

            $captionHtml = '';
            if (!empty($captionText)) {
                $cleanCaption = trim(strip_tags($captionText));
                $captionHtml = '<figcaption class="text-xs sm:text-sm text-slate-500 font-semibold mt-3 text-center tracking-wide">' . htmlspecialchars($cleanCaption, ENT_QUOTES, 'UTF-8') . '</figcaption>';
            }

            return '<figure class="my-8 text-center"><div class="inline-block overflow-hidden rounded-2xl border border-slate-200 shadow-sm bg-white p-2.5 max-w-full">' . $imgHtml . '</div>' . $captionHtml . '</figure>';
        }, $html);

        // 2. Rapikan gambar-gambar yang berjejer dalam satu paragraf <p style="text-align: center;"><a ...><img ...></a><img ...></p>
        $html = preg_replace_callback('/<p[^>]*style=["\'][^"\']*text-align:\s*center[^"\']*["\'][^>]*>(.*?)<\/p>/is', function ($matches) {
            $inner = $matches[1];
            // Jika berisi gambar
            if (str_contains($inner, '<img')) {
                // Hilangkan hardcoded width & height
                $inner = preg_replace('/\bwidth=["\']\d+["\']/i', '', $inner);
                $inner = preg_replace('/\bheight=["\']\d+["\']/i', '', $inner);
                // Tambahkan wrapper flex grid gambar yang rapi
                return '<div class="my-8 flex flex-wrap items-center justify-center gap-6 p-4 rounded-2xl bg-slate-50/80 border border-slate-200/80">' . $inner . '</div>';
            }
            return $matches[0];
        }, $html);

        // 3. Hapus duplikasi judul artikel di awal isi konten (h1, h2, h3 yang sama persis dengan title)
        $cleanTitle = preg_quote(trim($title), '/');
        $html = preg_replace('/^\s*<h[1-3][^>]*>\s*' . $cleanTitle . '\s*<\/h[1-3]>\s*/iu', '', $html);

        // 4. Bersihkan frasa-frasa terjemahan kaku / scrap aneh
        $translations = [
            'beberapa RCCB tersandung yang tidak diinginkan' => 'beberapa pemutusan arus (trip) yang tidak diinginkan (nuisance tripping)',
            'RCCB tersandung' => 'RCCB mengalami trip (pemutusan)',
            'tersandung' => 'trip (pemutusan sirkuit)',
            'peralatan tempur kita' => 'perangkat elektronik dan aset operasional kita',
            'Diri merasa rendah meskipun tenggat waktu mendekat.' => 'Pekerjaan berharga dapat terganggu di tengah tenggat waktu yang ketat.',
            'pekerjaan atau kemajuan yang sedang dibuat belum terselamatkan? atau dia tidak diselamatkan .. atau hanya diselamatkan?' => 'pekerjaan atau progres penting yang sedang dikerjakan belum sempat tersimpan?',
            'guncangan garis-netral' => 'gangguan lonjakan fasa ke netral (line-to-neutral surge)',
            'Sistem Penyimpanan Baterai Listrik \'BESS\'41;' => 'Sistem Penyimpanan Baterai Listrik (BESS)',
            'Uninterruptible Power Supply (UPS), atau di Indonesia, Uninterruptible Power Supply atau Uninterruptible Power Supply' => 'Uninterruptible Power Supply (UPS), atau penyedia catu daya bebas gangguan',
            'kelebihan arus saat ini' => 'kelebihan arus (overcurrent)',
            'koil netral perangkat' => 'toroid kumparan sensor arus sisa',
            'kelumpuhan pernapasan sekitar 30mA' => 'gangguan pernapasan dan risiko henti jantung (ventricular fibrillation)',
        ];

        foreach ($translations as $bad => $good) {
            $html = str_ireplace($bad, $good, $html);
        }

        // 5. Bersihkan tautan merah jadul (color: #ff0000)
        $html = preg_replace('/style=["\']color:\s*#ff0000;?["\']/i', 'class="text-rose-600 font-bold hover:underline"', $html);

        // 6. Bersihkan tag kosong <div class="wp-block-image"></div>
        $html = preg_replace('/<div class="wp-block-image"><\/div>/i', '', $html);

        // 7. Bersihkan <hr> berlebih di akhir konten
        $html = preg_replace('/(<hr[^>]*>\s*)+$/i', '', trim($html));

        return trim($html);
    }

    /**
     * Match keywords against engineering taxonomy dictionary.
     */
    protected function extractMatchingTags(string $title, string $slug, string $content, array $tagModels): array
    {
        $haystack = strtolower($title . ' ' . $slug . ' ' . strip_tags($content));
        $matched = [];

        foreach ($this->tagRules as $tagName => $keywords) {
            foreach ($keywords as $kw) {
                if (str_contains($haystack, strtolower($kw))) {
                    if (isset($tagModels[$tagName])) {
                        $matched[] = $tagModels[$tagName];
                    }
                    break;
                }
            }
        }

        // Pastikan setiap artikel memiliki setidaknya 2 tag umum jika tidak terdeteksi
        if (empty($matched)) {
            if (isset($tagModels['Circuit Breaker'])) $matched[] = $tagModels['Circuit Breaker'];
            if (isset($tagModels['Standar PUIL & Keselamatan'])) $matched[] = $tagModels['Standar PUIL & Keselamatan'];
            if (isset($tagModels['Schneider Electric'])) $matched[] = $tagModels['Schneider Electric'];
        }

        return array_unique(array_slice($matched, 0, 5));
    }
}
