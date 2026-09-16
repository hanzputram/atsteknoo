<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\LiveChatMessage;
use App\Models\LiveChatSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LiveChatController extends Controller
{
    /**
     * Check for incoming visitor messages, unread sessions count, urgent AI takeovers, and desktop notification triggers.
     */
    public function checkNotifications(Request $request): JsonResponse
    {
        $lastSeenId = (int) $request->query('last_seen_id', 0);
        $lastSeenInquiryId = (int) $request->query('last_seen_inquiry_id', 0);

        // Count unread active sessions
        $unreadCount = LiveChatSession::where('is_archived', false)
            ->where('status', 'unread')
            ->count();

        // Count sessions where AI flagged for human takeover
        $takeoverSessions = LiveChatSession::where('is_archived', false)
            ->where('needs_human_takeover', true)
            ->get(['id', 'visitor_name', 'visitor_contact', 'last_message_at']);

        // Get latest visitor message
        $latestVisitorMsg = LiveChatMessage::where('sender', 'visitor')
            ->with('session')
            ->latest('id')
            ->first();

        $hasNew = false;
        if ($latestVisitorMsg && $lastSeenId > 0 && $latestVisitorMsg->id > $lastSeenId) {
            $hasNew = true;
        }

        // Check unread inquiries (Pesan Masuk)
        $unreadInquiriesCount = \App\Models\ContactInquiry::where('status', 'unread')->count();
        $latestInquiry = \App\Models\ContactInquiry::latest('id')->first();
        $hasNewInquiry = false;
        if ($latestInquiry && $lastSeenInquiryId > 0 && $latestInquiry->id > $lastSeenInquiryId) {
            $hasNewInquiry = true;
        }

        return response()->json([
            'unread_count' => $unreadCount,
            'takeover_count' => $takeoverSessions->count(),
            'needs_urgent_takeover' => $takeoverSessions->count() > 0,
            'takeover_sessions' => $takeoverSessions,
            'latest_id' => $latestVisitorMsg ? $latestVisitorMsg->id : 0,
            'has_new' => $hasNew,
            'latest_message' => ($latestVisitorMsg && $hasNew) ? [
                'id' => $latestVisitorMsg->id,
                'session_id' => $latestVisitorMsg->session_id,
                'visitor_name' => $latestVisitorMsg->session ? $latestVisitorMsg->session->visitor_name : 'Pengunjung Web',
                'visitor_contact' => $latestVisitorMsg->session ? $latestVisitorMsg->session->visitor_contact : '',
                'message' => Str::limit($latestVisitorMsg->message, 120),
                'time' => $latestVisitorMsg->created_at->timezone('Asia/Jakarta')->format('H:i'),
            ] : null,
            'unread_inquiries_count' => $unreadInquiriesCount,
            'latest_inquiry_id' => $latestInquiry ? $latestInquiry->id : 0,
            'has_new_inquiry' => $hasNewInquiry,
            'latest_inquiry' => ($latestInquiry && $hasNewInquiry) ? [
                'id' => $latestInquiry->id,
                'name' => $latestInquiry->name,
                'email' => $latestInquiry->email,
                'phone' => $latestInquiry->phone,
                'subject' => Str::limit($latestInquiry->subject ?? 'Pesan Kontak Baru', 60),
                'message' => Str::limit($latestInquiry->message, 100),
                'time' => $latestInquiry->created_at->timezone('Asia/Jakarta')->format('H:i'),
            ] : null,
        ]);
    }

    public function index(Request $request)
    {
        $query = LiveChatSession::with(['latestMessage']);
        $status = $request->input('status');

        if ($status === 'archived') {
            $query->where('is_archived', true);
        } else {
            $query->where('is_archived', false);
            if ($status) {
                $query->where('status', $status);
            }
        }

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('visitor_name', 'like', "%{$search}%")
                  ->orWhere('visitor_contact', 'like', "%{$search}%");
            });
        }

        $sessions = $query->orderByDesc('last_message_at')
            ->paginate(20)
            ->withQueryString();

        $unreadCount = LiveChatSession::where('is_archived', false)->where('status', 'unread')->count();
        $activeCount = LiveChatSession::where('is_archived', false)->where('status', 'active')->count();
        $closedCount = LiveChatSession::where('is_archived', false)->where('status', 'closed')->count();
        $archivedCount = LiveChatSession::where('is_archived', true)->count();
        $takeoverCount = LiveChatSession::where('is_archived', false)->where('needs_human_takeover', true)->count();

        return view('backoffice.live-chats.index', compact(
            'sessions',
            'unreadCount',
            'activeCount',
            'closedCount',
            'archivedCount',
            'takeoverCount'
        ));
    }

    public function show(int $id)
    {
        $session = LiveChatSession::with(['messages.admin'])->findOrFail($id);

        // Mark all unread visitor messages as read
        $session->messages()
            ->where('sender', 'visitor')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        if ($session->status === 'unread') {
            $session->update(['status' => 'active']);
        }

        return view('backoffice.live-chats.show', compact('session'));
    }

    public function reply(Request $request, int $id)
    {
        $session = LiveChatSession::findOrFail($id);

        $request->validate([
            'message' => 'required|string|max:3000',
        ]);

        $message = LiveChatMessage::create([
            'session_id' => $session->id,
            'sender' => 'admin',
            'message' => $request->input('message'),
            'is_read' => true,
            'is_ai' => false,
            'admin_id' => auth()->id(),
        ]);

        $session->update([
            'status' => 'active',
            'last_message_at' => now(),
            'admin_typing_at' => null,
            'admin_engaged_at' => now(),
            'needs_human_takeover' => false, // Handled by human admin!
        ]);

        AuditLog::log('REPLY_CHAT', 'LiveChatSession', $session->id, ['reply_id' => $message->id]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => [
                    'id' => $message->id,
                    'sender' => 'admin',
                    'is_ai' => false,
                    'message' => $message->message,
                    'time' => $message->created_at->timezone('Asia/Jakarta')->format('H:i'),
                    'admin_name' => auth()->user()->name ?? 'ATS Support',
                ],
            ]);
        }

        return back()->with('success', 'Balasan live chat berhasil dikirim.');
    }

    public function updateTyping(Request $request, int $id): JsonResponse
    {
        $session = LiveChatSession::findOrFail($id);
        $isTyping = filter_var($request->input('typing', true), FILTER_VALIDATE_BOOLEAN);

        $session->update([
            'admin_typing_at' => $isTyping ? now() : null,
        ]);

        return response()->json([
            'success' => true,
            'is_typing' => $session->isVisitorTyping(),
        ]);
    }

    public function poll(int $id): JsonResponse
    {
        $session = LiveChatSession::with(['messages.admin'])->findOrFail($id);

        // Mark visitor messages as read
        $session->messages()
            ->where('sender', 'visitor')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = $session->messages->map(function ($msg) {
            return [
                'id' => $msg->id,
                'sender' => $msg->sender,
                'is_ai' => (bool) $msg->is_ai,
                'message' => $msg->message,
                'time' => $msg->created_at->timezone('Asia/Jakarta')->format('H:i'),
                'admin_name' => $msg->is_ai ? 'ATS Support (Auto)' : ($msg->admin ? $msg->admin->name : 'ATS Support'),
            ];
        });

        return response()->json([
            'status' => $session->status,
            'is_archived' => (bool) $session->is_archived,
            'ai_enabled' => (bool) $session->ai_enabled,
            'needs_human_takeover' => (bool) $session->needs_human_takeover,
            'is_typing' => $session->isVisitorTyping(),
            'visitor_name' => $session->visitor_name,
            'messages' => $messages,
        ]);
    }

    public function archive(int $id)
    {
        $session = LiveChatSession::findOrFail($id);
        $session->update([
            'is_archived' => true,
            'archived_at' => now(),
            'status' => 'closed',
            'needs_human_takeover' => false,
        ]);

        AuditLog::log('ARCHIVE_CHAT', 'LiveChatSession', $session->id);

        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'is_archived' => true]);
        }

        return back()->with('success', 'Sesi chat berhasil diarsipkan.');
    }

    public function unarchive(int $id)
    {
        $session = LiveChatSession::findOrFail($id);
        $session->update([
            'is_archived' => false,
            'archived_at' => null,
            'status' => 'active',
        ]);

        AuditLog::log('UNARCHIVE_CHAT', 'LiveChatSession', $session->id);

        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'is_archived' => false]);
        }

        return back()->with('success', 'Sesi chat berhasil dipulihkan dari arsip.');
    }

    public function toggleAi(Request $request, int $id): JsonResponse
    {
        $session = LiveChatSession::findOrFail($id);
        $enabled = $request->has('ai_enabled')
            ? filter_var($request->input('ai_enabled'), FILTER_VALIDATE_BOOLEAN)
            : !$session->ai_enabled;

        $session->update([
            'ai_enabled' => $enabled,
        ]);

        AuditLog::log('TOGGLE_AI_CHAT', 'LiveChatSession', $session->id, ['ai_enabled' => $enabled]);

        return response()->json([
            'success' => true,
            'ai_enabled' => $enabled,
            'message' => $enabled ? 'AI Auto-Reply diaktifkan untuk sesi ini.' : 'AI Auto-Reply dijeda. Admin menangani secara manual.',
        ]);
    }

    public function close(int $id)
    {
        $session = LiveChatSession::findOrFail($id);
        $session->update(['status' => 'closed']);

        AuditLog::log('CLOSE_CHAT', 'LiveChatSession', $session->id);

        return back()->with('success', 'Sesi chat telah ditandai selesai/ditutup.');
    }

    public function destroy(int $id)
    {
        $session = LiveChatSession::findOrFail($id);
        $session->delete();

        AuditLog::log('DELETE_CHAT', 'LiveChatSession', $id);

        return redirect()->route('backoffice.live-chats.index')->with('success', 'Sesi live chat berhasil dihapus.');
    }
}

