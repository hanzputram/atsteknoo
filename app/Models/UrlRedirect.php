<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlRedirect extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_url',
        'target_url',
        'status_code',
    ];

    protected $casts = [
        'status_code' => 'integer',
    ];
}
