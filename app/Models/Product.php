<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sku',
        'normalized_sku',
        'name',
        'slug',
        'short_description',
        'description_html',
        'brand_id',
        'primary_category_id',
        'main_image_id',
        'image_url',
        'datasheet_id',
        'datasheet_url',
        'meta_title',
        'meta_description',
        'is_featured',
        'sort_order',
        'listrikonline_clicks',
        'last_clicked_at',
        'status',
        'published_at',
        'lock_version',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'last_clicked_at' => 'datetime',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'listrikonline_clicks' => 'integer',
        'lock_version' => 'integer',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class, 'category_product', 'product_id', 'category_id');
    }

    public function primaryCategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'primary_category_id');
    }

    public function mainImage(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'main_image_id');
    }

    public function datasheet(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'datasheet_id');
    }

    public function specifications(): HasMany
    {
        return $this->hasMany(ProductSpecification::class, 'product_id')->orderBy('sort_order')->orderBy('id');
    }

    public function mediaUsages(): MorphMany
    {
        return $this->morphMany(MediaUsage::class, 'model')->orderBy('sort_order');
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

    public function getMainImageUrlAttribute(): ?string
    {
        if ($this->main_image_id) {
            return route('media.view', $this->main_image_id);
        }

        return $this->image_url ?: null;
    }

    public function getDatasheetLinkAttribute(): ?string
    {
        if ($this->datasheet_id) {
            return route('media.view', $this->datasheet_id);
        }

        return $this->datasheet_url ?: null;
    }

    public static function normalizeSku(string $sku): string
    {
        return strtoupper(trim($sku));
    }

    public function listrikonlineClickLogs(): HasMany
    {
        return $this->hasMany(ListrikonlineClickLog::class, 'product_id')->latest('created_at');
    }

    public function recordListrikonlineClick(?string $ip = null, ?string $userAgent = null, ?string $referer = null): void
    {
        try {
            // 1. Single atomic query for counter and timestamp (zero lock overhead)
            $this->increment('listrikonline_clicks', 1, [
                'last_clicked_at' => now(),
            ]);

            // 2. Lightweight audit log insertion
            ListrikonlineClickLog::create([
                'product_id' => $this->id,
                'sku' => $this->sku,
                'ip_address' => $ip,
                'user_agent' => $userAgent ? substr($userAgent, 0, 500) : null,
                'referer' => $referer ? substr($referer, 0, 500) : null,
                'created_at' => now(),
            ]);

            // 3. Clear short-lived KPI cache for immediate real-time sync
            \Illuminate\Support\Facades\Cache::forget('backoffice_sidebar_today_clicks');
            \Illuminate\Support\Facades\Cache::forget('listrikonline_kpis');
            \Illuminate\Support\Facades\Cache::forget('listrikonline_dashboard_stats');
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('ListrikOnline click logging skipped: ' . $e->getMessage());
        }
    }

    public function getListrikonlineUrlAttribute(): string
    {
        if (!empty($this->sku)) {
            return 'https://listrikonline.com/products/' . rawurlencode($this->sku);
        }
        return 'https://listrikonline.com';
    }
}
