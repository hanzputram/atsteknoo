<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content_html',
        'thumbnail_id',
        'thumbnail_alt',
        'image_url',
        'category_id',
        'author_id',
        'author_display_name',
        'meta_title',
        'meta_description',
        'is_featured',
        'status',
        'published_at',
        'lock_version',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'lock_version' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'article_tag', 'article_id', 'tag_id');
    }

    public function thumbnail(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'thumbnail_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function isPublished(): bool
    {
        return $this->status === 'published' && $this->published_at && $this->published_at->lte(now());
    }

    public function isScheduled(): bool
    {
        return $this->status === 'published' && $this->published_at && $this->published_at->gt(now());
    }

    public function getEffectiveAuthorNameAttribute(): string
    {
        if (!empty($this->author_display_name)) {
            return $this->author_display_name;
        }

        return $this->author ? $this->author->name : 'PT. ATS Editorial Team';
    }

    public function getThumbnailUrlAttribute(): string
    {
        // 1. First Priority: Uploaded MediaAsset in backoffice
        if ($this->thumbnail_id && $this->thumbnail) {
            return route('media.view', $this->thumbnail->id);
        }

        // 2. Second Priority: Explicit image_url (fallback for external/CDN URLs)
        if (!empty($this->image_url)) {
            // Guard against legacy 404 wp-content paths that do not exist on disk
            if (str_contains($this->image_url, 'wp-content/uploads/')) {
                $relativePath = parse_url($this->image_url, PHP_URL_PATH) ?? $this->image_url;
                $relativePath = ltrim($relativePath, '/');
                if (!file_exists(public_path($relativePath))) {
                    return asset('images/projects/project-1-substation.webp');
                }
            }

            return $this->image_url;
        }

        // 3. Final Default Fallback Image
        return asset('images/projects/project-1-substation.webp');
    }

    public function getReadTimeAttribute(): string
    {
        $wordCount = str_word_count(strip_tags($this->content_html ?? ''));
        $minutes = max(4, ceil($wordCount / 180));
        return $minutes . ' min read';
    }

    /**
     * Generate a guaranteed unique slug for articles.
     */
    public static function generateUniqueSlug(string $title, ?string $customSlug = null, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($customSlug ?: $title);
        if (empty($baseSlug)) {
            $baseSlug = 'article-' . strtolower(Str::random(6));
        }

        $slug = $baseSlug;
        $count = 2;

        while (static::withTrashed()->where('slug', $slug)->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$baseSlug}-{$count}";
            $count++;
        }

        return $slug;
    }
}
