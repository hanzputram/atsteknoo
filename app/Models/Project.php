<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'project_code',
        'title',
        'slug',
        'summary',
        'content_html',
        'category_id',
        'client_name',
        'location',
        'completion_year',
        'scope_of_work',
        'cover_image_id',
        'cover_alt',
        'meta_title',
        'meta_description',
        'is_featured',
        'sort_order',
        'status',
        'published_at',
        'lock_version',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'lock_version' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    public function coverImage(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'cover_image_id');
    }

    public function galleryUsages(): MorphMany
    {
        return $this->morphMany(MediaUsage::class, 'model')
            ->where('collection_name', 'gallery')
            ->orderBy('sort_order');
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

    public function getImageUrlAttribute(): string
    {
        if ($this->coverImage) {
            return route('media.view', $this->coverImage->id);
        }

        $slugImageMap = [
            'pakuwon-mall-superblock-power-substation' => 'project-1-substation.jpg',
            'indofood-cbp-motor-control-center-mcc' => 'project-2-indofood-mcc.jpg',
            'bumi-menara-internusa-cold-chain-scada' => 'project-3-coldstorage.jpg',
            'teluk-lamong-port-terminal-infrastructure' => 'project-4-scada-control.jpg',
            'dua-kelinci-packaging-automation' => 'project-5-packaging-vfd.jpg',
            'freeport-indonesia-smelter-power-distribution' => 'project-6-smelter-heavy.jpg',
            'surabaya-tier-3-data-center-power-busway' => 'project-7-datacenter-busway.jpg',
            'maspion-industrial-estate-20kv-substation' => 'project-8-industrial-park.jpg',
        ];

        if (isset($slugImageMap[$this->slug]) && file_exists(public_path('images/projects/' . $slugImageMap[$this->slug]))) {
            return asset('images/projects/' . $slugImageMap[$this->slug]);
        }

        return asset('images/projects/project-1-substation.jpg');
    }

    public function getBadgeNameAttribute(): string
    {
        return $this->category ? $this->category->name : 'Industrial Project';
    }

    public function getBadgeColorAttribute(): string
    {
        $colorMap = [
            1 => '#E11D48',
            2 => '#10B981',
            3 => '#0284C7',
            4 => '#7C3AED',
            5 => '#D97706',
            6 => '#DC2626',
            7 => '#06B6D4',
            8 => '#6366F1',
        ];

        return $colorMap[$this->sort_order % 8 ?: 8] ?? '#E11D48';
    }
}
