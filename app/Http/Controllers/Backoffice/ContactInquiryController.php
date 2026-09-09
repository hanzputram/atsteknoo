<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;

class ContactInquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactInquiry::query();

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $inquiries = $query->latest()->paginate(20)->withQueryString();

        return view('backoffice.inquiries.index', compact('inquiries'));
    }

    public function show(int $id)
    {
        $inquiry = ContactInquiry::findOrFail($id);

        if ($inquiry->status === 'unread') {
            $inquiry->update(['status' => 'read']);
        }

        return view('backoffice.inquiries.show', compact('inquiry'));
    }

    public function updateStatus(Request $request, int $id)
    {
        $inquiry = ContactInquiry::findOrFail($id);
        $request->validate([
            'status' => ['required', 'in:unread,read,handled,spam'],
        ]);

        $inquiry->update(['status' => $request->status]);

        AuditLog::log('UPDATE_STATUS', 'ContactInquiry', $inquiry->id, ['status' => $request->status]);

        return back()->with('success', 'Status pesan berhasil diperbarui.');
    }

    public function destroy(int $id)
    {
        $inquiry = ContactInquiry::findOrFail($id);
        $inquiry->delete();

        AuditLog::log('DELETE', 'ContactInquiry', $id);

        return redirect()->route('backoffice.inquiries.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
