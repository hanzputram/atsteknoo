<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportWpArticlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:import-wp-csv {file? : Path to the CSV file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete existing dummy articles and import real WordPress posts from CSV';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $filePath = $this->argument('file') ?: 'C:\Dwnlds\wpstg0_posts (2).csv';

        if (!file_exists($filePath)) {
            $this->error("CSV file not found at: {$filePath}");
            return Command::FAILURE;
        }

        $this->info("Starting article migration from: {$filePath}");

        // 1. Open CSV and read all rows
        $fp = fopen($filePath, 'r');
        $header = fgetcsv($fp);
        if (!$header) {
            $this->error("Could not read CSV header.");
            fclose($fp);
            return Command::FAILURE;
        }

        $rows = [];
        while (($row = fgetcsv($fp)) !== false) {
            if (count($row) === count($header)) {
                $rows[] = array_combine($header, $row);
            }
        }
        fclose($fp);

        $totalRows = count($rows);
        $this->info("Loaded {$totalRows} rows from CSV.");

        if ($totalRows === 0) {
            $this->warn("No rows found in CSV.");
            return Command::FAILURE;
        }

        // 2. Sort rows by tanggal_publish descending
        usort($rows, function ($a, $b) {
            $timeA = strtotime($a['tanggal_publish'] ?? '1970-01-01');
            $timeB = strtotime($b['tanggal_publish'] ?? '1970-01-01');
            return $timeB <=> $timeA;
        });

        // 3. Clear existing dummy articles and pivot relations
        $this->info("Clearing existing dummy articles and tags pivot...");
        DB::table('article_tag')->delete();
        Article::withTrashed()->forceDelete();

        $defaultUser = User::first();
        $defaultUserId = $defaultUser ? $defaultUser->id : 1;

        $usedSlugs = [];
        $importedCount = 0;

        $this->output->progressStart($totalRows);

        foreach ($rows as $index => $data) {
            $title = trim($data['judul'] ?? '');
            if (empty($title)) {
                continue;
            }

            // Clean slug
            $rawSlug = urldecode(trim($data['slug'] ?? ''));
            $baseSlug = Str::slug($rawSlug ?: $title);
            if (empty($baseSlug)) {
                $baseSlug = 'article-' . ($index + 1);
            }

            $slug = $baseSlug;
            $counter = 2;
            while (isset($usedSlugs[$slug]) || Article::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }
            $usedSlugs[$slug] = true;

            // Clean content
            $contentHtml = $this->cleanWpContent($data['isi_konten'] ?? '');

            // Excerpt
            $excerpt = trim($data['ringkasan'] ?? '');
            if (empty($excerpt)) {
                $plainText = preg_replace('/\s+/', ' ', strip_tags($contentHtml));
                $excerpt = Str::limit(trim($plainText), 160);
            }

            // Publish date
            $publishDate = null;
            if (!empty($data['tanggal_publish'])) {
                try {
                    $publishDate = Carbon::parse($data['tanggal_publish']);
                } catch (\Exception $e) {
                    $publishDate = now();
                }
            } else {
                $publishDate = now();
            }

            // Thumbnail URL
            $thumbnailUrl = trim($data['url_thumbnail'] ?? '');
            $thumbnailUrl = $this->normalizeImageUrl($thumbnailUrl);

            // Author display name
            $authorName = trim($data['penulis'] ?? '');
            if (empty($authorName)) {
                $authorName = 'PT. ATS Editorial Team';
            }

            // Determine category
            $categoryId = $this->determineCategory($title, $data['kategori_dan_tag'] ?? '');

            // First 7 recent articles are featured for the homepage carousel
            $isFeatured = ($index < 7);

            $article = Article::create([
                'title' => $title,
                'slug' => $slug,
                'excerpt' => $excerpt,
                'content_html' => $contentHtml,
                'image_url' => $thumbnailUrl ?: null,
                'thumbnail_alt' => $title,
                'category_id' => $categoryId,
                'author_id' => $defaultUserId,
                'author_display_name' => $authorName,
                'meta_title' => Str::limit($title, 70),
                'meta_description' => Str::limit($excerpt, 160),
                'is_featured' => $isFeatured,
                'status' => 'published',
                'published_at' => $publishDate,
                'created_at' => $publishDate,
                'updated_at' => $publishDate,
            ]);

            // Process tags from kategori_dan_tag
            $tagList = array_filter(array_map('trim', explode(',', $data['kategori_dan_tag'] ?? '')));
            $tagIds = [];
            foreach ($tagList as $tagStr) {
                if (strcasecmp($tagStr, 'Uncategorized') === 0 || empty($tagStr)) {
                    continue;
                }

                $tagSlug = Str::slug($tagStr);
                if (empty($tagSlug)) {
                    continue;
                }

                $tagModel = Tag::firstOrCreate(
                    ['slug' => $tagSlug],
                    ['name' => Str::limit($tagStr, 100), 'is_active' => true]
                );

                $tagIds[] = $tagModel->id;
            }

            if (!empty($tagIds)) {
                $article->tags()->sync(array_unique($tagIds));
            }

            $importedCount++;
            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
        $this->info("Successfully imported {$importedCount} articles into the database!");

        return Command::SUCCESS;
    }

    /**
     * Clean WordPress shortcodes and Enfold Avia builder tags into semantic HTML.
     */
    protected function cleanWpContent(string $raw): string
    {
        // 1. Remove wp:shortcode comments
        $text = preg_replace('/<!--\s*\/?wp:[a-z0-9_-]+\s*-->/i', '', $raw);

        // 2. Convert [av_image src='...' ...][/av_image] or self-closing to <img>
        $text = preg_replace_callback('/\[av_image\s+[^\]]*src=[\'"]([^\'"]+)[\'"][^\]]*\](?:.*?\[\/av_image\])?/is', function($m) {
            $src = htmlspecialchars($m[1], ENT_QUOTES, 'UTF-8');
            return '<figure class="my-6 text-center"><img src="' . $src . '" class="rounded-2xl max-w-full h-auto mx-auto shadow-sm" alt="" loading="lazy" /></figure>';
        }, $text);

        // 3. Convert [av_hr ...] to <hr />
        $text = preg_replace('/\[av_hr[^\]]*\]/i', '<hr class="my-8 border-slate-200" />', $text);

        // 4. Remove [av_productslider ...]
        $text = preg_replace('/\[av_productslider[^\]]*\](?:.*?\[\/av_productslider\])?/is', '', $text);

        // 5. Remove layout wrappers: [av_one_full ...], [/av_one_full], [av_two_third ...], [/av_two_third]
        $text = preg_replace('/\[\/?av_(?:one_full|two_third|one_half|one_third|three_fourth|cell)[^\]]*\]/i', '', $text);

        // 6. Remove [av_textblock ...] and [/av_textblock]
        $text = preg_replace('/\[\/?av_textblock[^\]]*\]/i', '', $text);

        // 7. Strip any remaining [av_...] shortcodes
        $text = preg_replace('/\[\/?av_[a-z0-9_]+[^\]]*\]/i', '', $text);

        // 8. Clean up extra newlines and trim
        $text = trim($text);

        // 9. Normalize image & media URLs (staging and old domains)
        $text = $this->normalizeImageUrl($text);

        // 10. If text doesn't contain HTML block tags, convert double linebreaks to <p>
        if (!preg_match('/<\s*(?:p|div|ul|ol|h[1-6]|table|blockquote)\b/i', $text)) {
            $paragraphs = preg_split('/\n\s*\n/', $text);
            $html = '';
            foreach ($paragraphs as $p) {
                $p = trim($p);
                if (!empty($p)) {
                    $html .= '<p>' . nl2br($p) . '</p>' . "\n";
                }
            }
            $text = $html;
        }

        return $text;
    }

    /**
     * Normalize image URLs from staging and legacy domains to production URLs.
     */
    protected function normalizeImageUrl(string $content): string
    {
        $replacements = [
            'https://atstekno.com/staging/' => 'https://atstekno.com/',
            'http://atstekno.com/staging/' => 'https://atstekno.com/',
            'https://ats.gbustudio.com/staging/' => 'https://atstekno.com/',
            'http://ats.gbustudio.com/staging/' => 'https://atstekno.com/',
            'https://ats.gbustudio.com/' => 'https://atstekno.com/',
            'http://ats.gbustudio.com/' => 'https://atstekno.com/',
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $content);
    }

    /**
     * Map article to appropriate category based on keywords in title & tags.
     */
    protected function determineCategory(string $title, string $tags): int
    {
        $haystack = strtolower($title . ' ' . $tags);

        if (preg_match('/\b(inverter|vfd|softstart|ats48|motor|drive)\b/i', $haystack)) {
            return 4; // Motor Control & Automation
        }
        if (preg_match('/\b(mcb|mccb|acb|fuse|relay|tdr|proteksi|protection|surge|breaker)\b/i', $haystack)) {
            return 5; // Industrial Protection
        }
        if (preg_match('/\b(panel|switchboard|lvmdp|ats|amf|clipsal|saklar|switch)\b/i', $haystack)) {
            return 2; // Switchboard Engineering
        }
        if (preg_match('/\b(kabel|cable|nyyhy|nym|warna kabel|liycy|kawat)\b/i', $haystack)) {
            return 8; // Electrical Standards
        }
        if (preg_match('/\b(temperature|controller|autonics|digital|sensor|iot|modbus)\b/i', $haystack)) {
            return 6; // Smart Industry 4.0
        }
        if (preg_match('/\b(kapasitor|capacitor|kvar|power factor|cos phi|harmonik)\b/i', $haystack)) {
            return 3; // Power Quality & Efficiency
        }

        return 1; // Technical Engineering Guides
    }
}
