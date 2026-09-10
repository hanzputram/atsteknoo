<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LiveChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'sender',
        'message',
        'is_read',
        'admin_id',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(LiveChatSession::class, 'session_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
