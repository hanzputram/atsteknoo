<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class MediaUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_id',
        'model_type',
        'model_id',
        'collection_name',
        'sort_order',
        'alt_text',
        'caption',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function media(): BelongsTo
    {
        return $this->belongsTo(MediaAsset::class, 'media_id');
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
