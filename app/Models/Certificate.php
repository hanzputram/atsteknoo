<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'partner_name',
        'badge_text',
        'description',
        'image_path',
        'is_landscape',
        'file_url',
        'sort_order',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_landscape' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected $appends = ['image_url'];

    public function isLandscape(): bool
    {
        return (bool) $this->is_landscape;
    }

    public function getImageUrlAttribute(): string
    {
        if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
            return $this->image_path;
        }

        $path = $this->image_path;
        if (str_ends_with(strtolower($path), '.webp')) {
            $pngPath = preg_replace('/\.webp$/i', '.png', $path);
            if (file_exists(public_path($pngPath))) {
                return asset($pngPath);
            }
            $jpgPath = preg_replace('/\.webp$/i', '.jpg', $path);
            if (file_exists(public_path($jpgPath))) {
                return asset($jpgPath);
            }
        }

        return asset($path);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
