<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class ListrikonlineClickLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'sku',
        'ip_address',
        'user_agent',
        'referer',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($log) {
            if (!$log->created_at) {
                $log->created_at = Carbon::now();
            }
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('created_at', Carbon::today());
    }

    public function scopeThisMonth(Builder $query): Builder
    {
        return $query->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),
        ]);
    }

    public function scopeLast7Days(Builder $query): Builder
    {
        return $query->where('created_at', '>=', Carbon::now()->subDays(7));
    }

    /**
     * Parse device type from user agent.
     */
    public function getDeviceTypeAttribute(): string
    {
        $ua = strtolower($this->user_agent ?? '');
        if (str_contains($ua, 'tablet') || str_contains($ua, 'ipad')) {
            return 'Tablet';
        }
        if (str_contains($ua, 'mobile') || str_contains($ua, 'android') || str_contains($ua, 'iphone')) {
            return 'Mobile';
        }
        return 'Desktop';
    }

    /**
     * Parse browser name from user agent.
     */
    public function getBrowserAttribute(): string
    {
        $ua = $this->user_agent ?? '';
        if (stripos($ua, 'Edg') !== false) return 'Edge';
        if (stripos($ua, 'Chrome') !== false) return 'Chrome';
        if (stripos($ua, 'Safari') !== false) return 'Safari';
        if (stripos($ua, 'Firefox') !== false) return 'Firefox';
        if (stripos($ua, 'Opera') !== false || stripos($ua, 'OPR') !== false) return 'Opera';
        return 'Web';
    }
}
