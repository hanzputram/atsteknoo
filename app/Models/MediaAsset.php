<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class MediaAsset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'disk',
        'file_path',
        'original_name',
        'mime_type',
        'file_size',
        'width',
        'height',
        'checksum',
        'media_type',
        'uploaded_by',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
    ];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function usages(): HasMany
    {
        return $this->hasMany(MediaUsage::class, 'media_id');
    }

    public function getUrlAttribute(): string
    {
        return route('media.view', ['id' => $this->id]);
    }

    public function isImage(): bool
    {
        return $this->media_type === 'image';
    }

    public function isDocument(): bool
    {
        return $this->media_type === 'document';
    }
}
