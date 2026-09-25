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

        $slug = strtolower($this->slug ?? '');
        $name = strtolower($this->name ?? '');
        $code = strtolower($this->code ?? '');

        // Direct mapping table for files located in public/logos/
        $logoMap = [
            'schneider-electric' => 'logos/1.webp',
            'schneider'          => 'logos/1.webp',
            'gae-group'          => 'logos/2.webp',
            'gae'                => 'logos/2.webp',
            'legrand-indonesia'  => 'logos/Legrand.webp',
            'legrand'            => 'logos/Legrand.webp',
            'socomec'            => 'logos/Socomec.webp',
            'autonics'           => 'logos/Autonics.webp',
            'himel'              => 'logos/Himel.webp',
            'panasonic'          => 'logos/Panasonic.webp',
            'philips-lighting'   => 'logos/Philips.webp',
            'philips'            => 'logos/Philips.webp',
            'fluke-corporation'  => 'logos/Fluke.webp',
            'fluke'              => 'logos/Fluke.webp',
            'boss-electrical'    => 'logos/Boss.webp',
            'boss'               => 'logos/Boss.webp',
            'jembo-cable'        => 'logos/Jembo.webp',
            'jembo'              => 'logos/Jembo.webp',
            'supreme-cable'      => 'logos/supremexxx.webp',
            'supreme'            => 'logos/supremexxx.webp',
            'dv-electric'        => 'logos/DV.webp',
            'dv'                 => 'logos/DV.webp',
            'vinsa'              => 'logos/vinsa.webp',
            // Newly added brand logos:
            '3m'                 => 'logos/3m.svg',
            'abb'                => 'logos/abb.webp',
            'broco'              => 'logos/broco.webp',
            'matsuyama'          => 'logos/matsuyama.webp',
            'omron'              => 'logos/omron.svg',
            'puma'               => 'logos/puma.webp',
        ];

        foreach ([$slug, $name, $code] as $k) {
            if ($k && isset($logoMap[$k]) && file_exists(public_path($logoMap[$k]))) {
                return asset($logoMap[$k]);
            }
        }

        // Keyword based mapping
        $keywordMap = [
            '3m'        => 'logos/3m.svg',
            'abb'       => 'logos/abb.webp',
            'broco'     => 'logos/broco.webp',
            'matsuyama' => 'logos/matsuyama.webp',
            'omron'     => 'logos/omron.svg',
            'puma'      => 'logos/puma.webp',
            'schneider' => 'logos/1.webp',
            'gae'       => 'logos/2.webp',
            'legrand'   => 'logos/Legrand.webp',
            'socomec'   => 'logos/Socomec.webp',
            'autonics'  => 'logos/Autonics.webp',
            'himel'     => 'logos/Himel.webp',
            'panasonic' => 'logos/Panasonic.webp',
            'philips'   => 'logos/Philips.webp',
            'fluke'     => 'logos/Fluke.webp',
            'boss'      => 'logos/Boss.webp',
            'jembo'     => 'logos/Jembo.webp',
            'supreme'   => 'logos/supremexxx.webp',
            'dv'        => 'logos/DV.webp',
            'vinsa'     => 'logos/vinsa.webp',
        ];

        foreach ($keywordMap as $kw => $path) {
            if ((str_contains($slug, $kw) || str_contains($name, $kw) || $code === $kw) && file_exists(public_path($path))) {
                return asset($path);
            }
        }

        // Generic checks in public/logos/
        $candidates = [
            "logos/{$slug}.webp",
            "logos/{$slug}.png",
            "logos/{$slug}.svg",
            "logos/{$slug}.jpg",
            "logos/{$name}.webp",
            "logos/{$name}.png",
            "logos/{$name}.svg",
            "logos/{$name}.jpg",
            "logos/" . ucfirst($slug) . ".webp",
            "logos/" . ucfirst($slug) . ".png",
            "logos/" . ucfirst($slug) . ".svg",
            "logos/{$code}.webp",
            "logos/{$code}.png",
            "logos/{$code}.svg",
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
