<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PriceList extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'brand_name',
        'edition_year',
        'category',
        'description',
        'thumbnail_url',
        'view_url',
        'download_url',
        'file_size',
        'tax_note',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = ['image_asset_url', 'effective_download_url'];

    public function getImageAssetUrlAttribute(): string
    {
        if (empty($this->thumbnail_url)) {
            return asset('images/pricelists/placeholder.png');
        }

        if (filter_var($this->thumbnail_url, FILTER_VALIDATE_URL)) {
            return $this->thumbnail_url;
        }

        return asset($this->thumbnail_url);
    }

    public function getEffectiveDownloadUrlAttribute(): string
    {
        if (!empty($this->download_url)) {
            return $this->download_url;
        }

        return $this->view_url;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeByBrand(Builder $query, string $brand): Builder
    {
        return $query->where('brand_name', 'like', '%' . $brand . '%');
    }
}
