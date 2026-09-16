<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiKnowledge extends Model
{
    use HasFactory;

    protected $table = 'ai_knowledges';

    protected $fillable = [
        'title',
        'category',
        'trigger_keywords',
        'content',
        'is_active',
        'priority',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'priority' => 'integer',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'product' => 'Produk & Merek',
            'pricing' => 'Harga & Penawaran',
            'faq' => 'Tanya Jawab (FAQ)',
            'policy' => 'Kebijakan & Garansi',
            'instruction' => 'Pedoman & Sikap',
            default => 'Umum & Profil',
        };
    }

    public function getCategoryBadgeClassAttribute(): string
    {
        return match ($this->category) {
            'product' => 'badge-primary',
            'pricing' => 'badge-warning',
            'faq' => 'badge-info',
            'policy' => 'badge-danger',
            'instruction' => 'badge-neutral',
            default => 'badge-neutral',
        };
    }
}
