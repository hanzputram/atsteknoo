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
        'is_archived',
        'archived_at',
        'ai_enabled',
        'needs_human_takeover',
        'admin_engaged_at',
        'ip_address',
        'last_message_at',
        'visitor_typing_at',
        'admin_typing_at',
    ];

    protected $casts = [
        'is_archived' => 'boolean',
        'archived_at' => 'datetime',
        'ai_enabled' => 'boolean',
        'needs_human_takeover' => 'boolean',
        'admin_engaged_at' => 'datetime',
        'last_message_at' => 'datetime',
        'visitor_typing_at' => 'datetime',
        'admin_typing_at' => 'datetime',
    ];

    protected $attributes = [
        'ai_enabled' => true,
        'is_archived' => false,
        'needs_human_takeover' => false,
    ];

    public function isVisitorTyping(): bool
    {
        return $this->visitor_typing_at !== null && $this->visitor_typing_at->diffInSeconds(now()) < 5;
    }

    public function isAdminTyping(): bool
    {
        // Admin considered typing if typed within the last 15 seconds
        return $this->admin_typing_at !== null && $this->admin_typing_at->diffInSeconds(now()) < 15;
    }

    public function canAiReply(): bool
    {
        $isArchived = (bool) ($this->is_archived ?? false);
        $aiEnabled = (bool) ($this->ai_enabled ?? true);

        if ($isArchived || !$aiEnabled) {
            return false;
        }

        // Do not collide if admin is actively typing in backoffice right now
        if ($this->isAdminTyping()) {
            return false;
        }

        // Do not collide if admin just sent a reply within the last 15 seconds
        if ($this->admin_engaged_at && $this->admin_engaged_at->diffInSeconds(now()) < 15) {
            return false;
        }

        return true;
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
