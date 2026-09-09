<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImportJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file_path',
        'file_name',
        'file_size',
        'checksum',
        'mode',
        'status',
        'total_rows',
        'valid_rows',
        'error_rows',
        'created_count',
        'updated_count',
        'unchanged_count',
        'failed_count',
        'skipped_count',
        'media_count',
        'schema_version',
        'plan_data',
        'error_report_path',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'total_rows' => 'integer',
        'valid_rows' => 'integer',
        'error_rows' => 'integer',
        'created_count' => 'integer',
        'updated_count' => 'integer',
        'unchanged_count' => 'integer',
        'failed_count' => 'integer',
        'skipped_count' => 'integer',
        'media_count' => 'integer',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
