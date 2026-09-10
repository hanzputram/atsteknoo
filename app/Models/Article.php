<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        if ($this->thumbnail) {
            return route('media.view', $this->thumbnail->id);
        }

        $slugImageMap = [
            'how-to-select-mccb-vs-acb-for-industrial-panels' => 'images/projects/project-1-substation.jpg',
            'designing-600kvar-automatic-capacitor-banks-power-factor' => 'images/projects/project-6-smelter-heavy.jpg',
            'vfd-harmonics-mitigation-industrial-pumping-systems' => 'images/projects/project-2-indofood-mcc.jpg',
            'mcc-sizing-type-2-coordination-arc-flash-safety' => 'images/projects/project-4-scada-control.jpg',
            'smart-electrical-switchboards-modbus-iot-energy-gateways' => 'images/projects/project-7-datacenter-busway.jpg',
            'ats-generator-synchronizing-zero-downtime-tier-3' => 'images/projects/project-3-coldstorage.jpg',
            'industrial-cable-sizing-derating-voltage-drop-calculations' => 'images/projects/project-8-industrial-park.jpg',
        ];

        if (isset($slugImageMap[$this->slug]) && file_exists(public_path($slugImageMap[$this->slug]))) {
            return asset($slugImageMap[$this->slug]);
        }

        return asset('images/projects/project-1-substation.jpg');
    }

    public function getReadTimeAttribute(): string
    {
        $wordCount = str_word_count(strip_tags($this->content_html ?? ''));
        $minutes = max(4, ceil($wordCount / 180));
        return $minutes . ' min read';
    }
}
