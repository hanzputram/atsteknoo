<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'slug',
        'logo_id',
        'logo_alt',
        'description_html',
        'website_url',
        'meta_title',
        'meta_description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function logo(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'logo_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

    protected $appends = ['logo_url'];

    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo) {
            return route('media.view', $this->logo_id);
        }

        $slug = $this->slug;
        $code = strtolower($this->code ?? '');

        // Direct mapping table for files located in public/logos/
        $logoMap = [
            'schneider-electric' => 'logos/1.webp',
            'gae-group'          => 'logos/2.webp',
            'legrand-indonesia'  => 'logos/Legrand.webp',
            'socomec'            => 'logos/Socomec.webp',
            'autonics'           => 'logos/Autonics.webp',
            'himel'              => 'logos/Himel.webp',
            'panasonic'          => 'logos/Panasonic.webp',
            'philips-lighting'   => 'logos/Philips.webp',
            'fluke-corporation'  => 'logos/Fluke.webp',
            'boss-electrical'    => 'logos/Boss.webp',
            'jembo-cable'        => 'logos/Jembo.webp',
            'supreme-cable'      => 'logos/supremexxx.webp',
            'dv-electric'        => 'logos/DV.webp',
            'vinsa'              => 'logos/vinsa.webp',
        ];

        if (isset($logoMap[$slug]) && file_exists(public_path($logoMap[$slug]))) {
            return asset($logoMap[$slug]);
        }

        // Generic checks in public/logos/
        $candidates = [
            "logos/{$slug}.webp",
            "logos/{$slug}.png",
            "logos/" . ucfirst($slug) . ".webp",
            "logos/" . ucfirst($slug) . ".png",
            "logos/{$code}.webp",
            "logos/{$code}.png",
            "logos/" . ucfirst($code) . ".webp",
            "logos/" . ucfirst($code) . ".png",
            "images/brands/{$slug}.webp",
            "images/brands/{$slug}.svg",
            "images/brands/{$slug}.png",
        ];

        foreach ($candidates as $cand) {
            if (file_exists(public_path($cand))) {
                return asset($cand);
            }
        }

        return null;
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
