<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('articles')->orderBy('name')->get();

        return view('backoffice.tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:tags,name'],
        ]);

        $tag = Tag::create([
            'name' => trim($request->name),
            'slug' => Str::slug($request->name),
            'is_active' => true,
        ]);

        AuditLog::log('CREATE', 'Tag', $tag->id, ['name' => $tag->name]);

        return back()->with('success', "Tag '{$tag->name}' berhasil ditambahkan.");
    }

    public function destroy(int $id)
    {
        $tag = Tag::findOrFail($id);
        $name = $tag->name;
        $tag->delete();

        AuditLog::log('DELETE', 'Tag', $tag->id, ['name' => $name]);

        return back()->with('success', "Tag '{$name}' berhasil dihapus.");
    }
}
