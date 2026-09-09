<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Page;
use App\Services\HtmlSanitizerService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('title')->get();

        return view('backoffice.pages.index', compact('pages'));
    }

    public function edit(int $id)
    {
        $page = Page::findOrFail($id);

        return view('backoffice.pages.edit', compact('page'));
    }

    public function update(Request $request, int $id)
    {
        $page = Page::findOrFail($id);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content_html' => ['nullable', 'string'],
        ]);

        $cleanContent = HtmlSanitizerService::clean($request->input('content_html'));

        $sectionsData = $page->sections_data ?? [];
        if ($request->has('sections')) {
            $sectionsData = $request->input('sections');
        }

        $page->update([
            'title' => trim($request->title),
            'content_html' => $cleanContent,
            'sections_data' => $sectionsData,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status' => $request->status ?? 'published',
            'lock_version' => $page->lock_version + 1,
            'updated_by' => auth()->id(),
        ]);

        AuditLog::log('UPDATE', 'Page', $page->id, ['title' => $page->title]);

        return redirect()->route('backoffice.pages.index')->with('success', "Halaman '{$page->title}' berhasil diperbarui.");
    }
}
