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
        'visitor_typing_at',
        'admin_typing_at',
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
        'visitor_typing_at' => 'datetime',
        'admin_typing_at' => 'datetime',
    ];

    public function isVisitorTyping(): bool
    {
        return $this->visitor_typing_at !== null && $this->visitor_typing_at->diffInSeconds(now()) < 5;
    }

    public function isAdminTyping(): bool
    {
        return $this->admin_typing_at !== null && $this->admin_typing_at->diffInSeconds(now()) < 5;
    }

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
