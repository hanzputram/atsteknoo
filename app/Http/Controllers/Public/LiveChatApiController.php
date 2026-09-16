<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\LiveChatMessage;
use App\Models\LiveChatSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LiveChatApiController extends Controller
{
    public function getSessionMessages(Request $request): JsonResponse
    {
        $token = $request->query('session_token');
        if (!$token) {
            return response()->json(['messages' => []]);
        }

        $session = LiveChatSession::where('session_token', $token)->first();
        if (!$session) {
            return response()->json(['messages' => []]);
        }

        $messages = $session->messages()
            ->select(['id', 'sender', 'message', 'is_ai', 'created_at'])
            ->get()
            ->map(function ($msg) {
                return [
                    'id' => $msg->id,
                    'sender' => $msg->sender,
                    'is_ai' => (bool) $msg->is_ai,
                    'sender_name' => ($msg->sender === 'admin') ? 'ATS Support' : 'Anda',
                    'message' => $msg->message,
                    'time' => $msg->created_at->timezone('Asia/Jakarta')->format('H:i'),
                ];
            });

        $lastActivity = $session->last_message_at ?: $session->created_at;
        $inactiveMinutes = $lastActivity ? (int) $lastActivity->diffInMinutes(now()) : 0;
        $isExpired = $inactiveMinutes >= 45;

        if ($isExpired && $session->status !== 'closed') {
            $session->update(['status' => 'closed']);
        }

        return response()->json([
            'session' => [
                'token' => $session->session_token,
                'name' => $session->visitor_name,
                'status' => $session->status,
                'is_admin_typing' => $session->isAdminTyping(),
                'last_message_at' => $lastActivity ? $lastActivity->toIso8601String() : null,
                'inactive_minutes' => $inactiveMinutes,
                'is_expired' => $isExpired,
            ],
            'is_typing' => $session->isAdminTyping(),
            'messages' => $messages,
        ]);
    }

    /**
     * Retrieve past chat transcripts for archived sessions tokens.
     */
    public function getChatHistory(Request $request): JsonResponse
    {
        $tokens = $request->input('tokens', []);
        if (empty($tokens) || !is_array($tokens)) {
            return response()->json(['sessions' => []]);
        }

        $sessions = LiveChatSession::whereIn('session_token', array_slice($tokens, 0, 30))
            ->with(['messages' => fn ($q) => $q->orderBy('created_at', 'asc')])
            ->orderByDesc('last_message_at')
            ->get()
            ->map(function ($s) {
                return [
                    'token' => $s->session_token,
                    'visitor_name' => $s->visitor_name,
                    'date' => $s->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i'),
                    'last_active' => $s->last_message_at ? $s->last_message_at->timezone('Asia/Jakarta')->format('d M Y, H:i') : $s->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i'),
                    'status' => $s->status,
                    'messages' => $s->messages->map(fn ($m) => [
                        'id' => $m->id,
                        'sender' => $m->sender,
                        'is_ai' => (bool) $m->is_ai,
                        'sender_name' => ($m->sender === 'admin') ? 'ATS Support' : 'Anda',
                        'message' => $m->message,
                        'time' => $m->created_at->timezone('Asia/Jakarta')->format('H:i'),
                    ]),
                ];
            });

        return response()->json(['sessions' => $sessions]);
    }

    public function updateTyping(Request $request): JsonResponse
    {
        $token = $request->input('session_token');
        if (!$token) {
            return response()->json(['success' => false, 'is_typing' => false]);
        }

        $session = LiveChatSession::where('session_token', $token)->first();
        if (!$session) {
            return response()->json(['success' => false, 'is_typing' => false]);
        }

        $isTyping = filter_var($request->input('typing', true), FILTER_VALIDATE_BOOLEAN);

        $session->update([
            'visitor_typing_at' => $isTyping ? now() : null,
        ]);

        return response()->json([
            'success' => true,
            'is_typing' => $session->isAdminTyping(),
        ]);
    }

    public function sendMessage(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:2000',
            'session_token' => 'nullable|string',
            'name' => 'required|string|min:2|max:100',
            'contact' => 'required|string|min:4|max:100',
        ], [
            'name.required' => 'Nama atau Nama PT wajib dicantumkan sebelum mengirim pesan.',
            'name.min' => 'Nama atau Nama PT minimal 2 karakter.',
            'contact.required' => 'Nomor WhatsApp atau Email wajib dicantumkan.',
            'contact.min' => 'Nomor WhatsApp atau Email minimal 4 karakter.',
            'message.required' => 'Pesan konsultasi tidak boleh kosong.',
        ]);

        $token = $request->input('session_token');
        $session = null;

        if ($token) {
            $session = LiveChatSession::where('session_token', $token)->first();
        }

        if (!$session) {
            $token = 'ats_' . Str::random(24);
            $session = LiveChatSession::create([
                'session_token' => $token,
                'visitor_name' => $request->input('name'),
                'visitor_contact' => $request->input('contact'),
                'status' => 'unread',
                'ip_address' => $request->ip(),
                'last_message_at' => now(),
                'visitor_typing_at' => null,
                'ai_enabled' => true,
                'is_archived' => false,
                'needs_human_takeover' => false,
            ]);
        } else {
            // Update name / contact if provided
            $updates = [
                'visitor_name' => $request->input('name'),
                'visitor_contact' => $request->input('contact'),
                'last_message_at' => now(),
                'status' => 'unread',
                'visitor_typing_at' => null,
            ];
            $session->update($updates);
        }

        $chatMsg = LiveChatMessage::create([
            'session_id' => $session->id,
            'sender' => 'visitor',
            'message' => $request->input('message'),
            'is_read' => false,
        ]);

        $aiReplyData = null;

        // Anti-collision & AI reply check:
        // 1. Session must not be archived
        // 2. Session must have ai_enabled = true
        // 3. Admin must NOT be currently typing (isAdminTyping == false)
        // 4. Admin has not actively engaged within the last 3 minutes
        if ($session->canAiReply()) {
            $gemini = app(\App\Services\GeminiChatService::class);
            if ($gemini->isConfigured()) {
                $aiResult = $gemini->generateReply($session, $request->input('message'));
                if ($aiResult && !empty($aiResult['reply'])) {
                    // Anti-collision: re-verify session in case admin intervened during Gemini generation
                    $session->refresh();
                    $adminIntervened = $session->isAdminTyping() || 
                        $session->messages()
                            ->where('sender', 'admin')
                            ->where('is_ai', false)
                            ->where('created_at', '>=', $chatMsg->created_at)
                            ->exists();

                    if (!$adminIntervened) {
                        $aiMsg = LiveChatMessage::create([
                            'session_id' => $session->id,
                            'sender' => 'admin',
                            'message' => $aiResult['reply'],
                            'is_read' => true,
                            'is_ai' => true,
                        ]);

                        $session->update([
                            'last_message_at' => now(),
                            'needs_human_takeover' => $session->needs_human_takeover || (bool) $aiResult['needs_human_takeover'],
                        ]);

                        $aiReplyData = [
                            'id' => $aiMsg->id,
                            'sender' => 'admin',
                            'is_ai' => true,
                            'sender_name' => 'ATS Support',
                            'message' => $aiMsg->message,
                            'time' => $aiMsg->created_at->timezone('Asia/Jakarta')->format('H:i'),
                        ];
                    }
                }
            }
        }

        return response()->json([
            'success' => true,
            'session_token' => $session->session_token,
            'message' => [
                'id' => $chatMsg->id,
                'sender' => $chatMsg->sender,
                'is_ai' => false,
                'sender_name' => 'Anda',
                'message' => $chatMsg->message,
                'time' => $chatMsg->created_at->timezone('Asia/Jakarta')->format('H:i'),
            ],
            'ai_reply' => $aiReplyData,
        ]);
    }
}
