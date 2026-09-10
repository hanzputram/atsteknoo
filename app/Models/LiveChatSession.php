<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LiveChatSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_token',
        'visitor_name',
        'visitor_contact',
        'status',
        'ip_address',
        'last_message_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(LiveChatMessage::class, 'session_id')->orderBy('created_at', 'asc');
    }

    public function latestMessage()
    {
        return $this->hasOne(LiveChatMessage::class, 'session_id')->latestOfMany();
    }

    public function unreadMessagesCount(): int
    {
        return $this->messages()->where('sender', 'visitor')->where('is_read', false)->count();
    }
}
