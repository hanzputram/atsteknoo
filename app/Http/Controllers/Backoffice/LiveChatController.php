<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\LiveChatMessage;
use App\Models\LiveChatSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LiveChatController extends Controller
{
    public function index(Request $request)
    {
        $query = LiveChatSession::with(['latestMessage']);

        if ($status = $request->input('status')) {
            $query->where('status', $status);
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

        $unreadCount = LiveChatSession::where('status', 'unread')->count();

        return view('backoffice.live-chats.index', compact('sessions', 'unreadCount'));
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
            'admin_id' => auth()->id(),
        ]);

        $session->update([
            'status' => 'active',
            'last_message_at' => now(),
            'admin_typing_at' => null,
        ]);

        AuditLog::log('REPLY_CHAT', 'LiveChatSession', $session->id, ['reply_id' => $message->id]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => [
                    'id' => $message->id,
                    'sender' => 'admin',
                    'message' => $message->message,
                    'time' => $message->created_at->format('H:i'),
                    'admin_name' => auth()->user()->name ?? 'Engineer ATS',
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
                'message' => $msg->message,
                'time' => $msg->created_at->format('H:i'),
                'admin_name' => $msg->admin ? $msg->admin->name : 'Engineer ATS',
            ];
        });

        return response()->json([
            'status' => $session->status,
            'is_typing' => $session->isVisitorTyping(),
            'visitor_name' => $session->visitor_name,
            'messages' => $messages,
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
