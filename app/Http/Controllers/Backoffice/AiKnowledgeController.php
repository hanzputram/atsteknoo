<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\AiKnowledge;
use App\Services\GeminiChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AiKnowledgeController extends Controller
{
    /**
     * Display a listing of AI knowledge base items.
     */
    public function index(Request $request): View
    {
        $query = AiKnowledge::query()->with('creator');

        if ($request->filled('q')) {
            $search = '%' . trim($request->input('q')) . '%';
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', $search)
                  ->orWhere('content', 'like', $search)
                  ->orWhere('trigger_keywords', 'like', $search);
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('status')) {
            if ($request->input('status') === 'active') {
                $query->where('is_active', true);
            } elseif ($request->input('status') === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $knowledges = $query->orderBy('priority', 'asc')->orderBy('id', 'asc')->paginate(20)->withQueryString();

        // Statistics
        $totalCount = AiKnowledge::count();
        $activeCount = AiKnowledge::where('is_active', true)->count();
        $productCount = AiKnowledge::where('category', 'product')->count();
        $pricingCount = AiKnowledge::where('category', 'pricing')->count();
        $faqCount = AiKnowledge::where('category', 'faq')->count();

        $categories = [
            'product' => 'Produk & Merek',
            'pricing' => 'Harga & Penawaran',
            'faq' => 'Tanya Jawab (FAQ)',
            'policy' => 'Kebijakan & Garansi',
            'instruction' => 'Pedoman & Sikap',
            'general' => 'Umum & Profil',
        ];

        return view('backoffice.ai-knowledge.index', compact(
            'knowledges',
            'totalCount',
            'activeCount',
            'productCount',
            'pricingCount',
            'faqCount',
            'categories'
        ));
    }

    /**
     * Show the form for creating a new knowledge entry.
     */
    public function create(): View
    {
        $categories = [
            'product' => 'Produk & Merek (Spesifikasi, Stok, Tipe)',
            'pricing' => 'Harga & Penawaran (Diskon Proyek, Estimasi, SOP BoQ)',
            'faq' => 'Tanya Jawab (FAQ - Pertanyaan Umum Pengunjung)',
            'policy' => 'Kebijakan, Pengiriman & Garansi Resmi',
            'instruction' => 'Pedoman Sikap, Gaya Bahasa & Pantangan',
            'general' => 'Umum & Profil Perusahaan (Lokasi, Cabang, Jam Kerja)',
        ];

        return view('backoffice.ai-knowledge.create', compact('categories'));
    }

    /**
     * Store a newly created knowledge item.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:product,pricing,faq,policy,instruction,general',
            'trigger_keywords' => 'nullable|string|max:255',
            'content' => 'required|string|max:5000',
            'priority' => 'nullable|integer|min:0|max:9999',
            'is_active' => 'nullable|boolean',
        ], [
            'title.required' => 'Judul memori / topik pengetahuan wajib diisi.',
            'category.required' => 'Pilih salah satu kategori.',
            'content.required' => 'Isi materi pengetahuan / instruksi tidak boleh kosong.',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['priority'] = $request->input('priority', 10) ?? 10;
        $validated['created_by'] = auth()->id();

        AiKnowledge::create($validated);

        return redirect()
            ->route('backoffice.ai-knowledge.index')
            ->with('success', 'Memori & pengetahuan baru berhasil disimpan dan langsung diajarkan ke ATS Support!');
    }

    /**
     * Show the form for editing the specified knowledge.
     */
    public function edit(AiKnowledge $aiKnowledge): View
    {
        $categories = [
            'product' => 'Produk & Merek (Spesifikasi, Stok, Tipe)',
            'pricing' => 'Harga & Penawaran (Diskon Proyek, Estimasi, SOP BoQ)',
            'faq' => 'Tanya Jawab (FAQ - Pertanyaan Umum Pengunjung)',
            'policy' => 'Kebijakan, Pengiriman & Garansi Resmi',
            'instruction' => 'Pedoman Sikap, Gaya Bahasa & Pantangan',
            'general' => 'Umum & Profil Perusahaan (Lokasi, Cabang, Jam Kerja)',
        ];

        return view('backoffice.ai-knowledge.edit', [
            'knowledge' => $aiKnowledge,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified knowledge item.
     */
    public function update(Request $request, AiKnowledge $aiKnowledge): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:product,pricing,faq,policy,instruction,general',
            'trigger_keywords' => 'nullable|string|max:255',
            'content' => 'required|string|max:5000',
            'priority' => 'nullable|integer|min:0|max:9999',
            'is_active' => 'nullable|boolean',
        ], [
            'title.required' => 'Judul memori / topik pengetahuan wajib diisi.',
            'category.required' => 'Pilih salah satu kategori.',
            'content.required' => 'Isi materi pengetahuan / instruksi tidak boleh kosong.',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['priority'] = $request->input('priority', 10) ?? 10;

        $aiKnowledge->update($validated);

        return redirect()
            ->route('backoffice.ai-knowledge.index')
            ->with('success', 'Pengetahuan AI berhasil diperbarui!');
    }

    /**
     * Remove the specified knowledge item.
     */
    public function destroy(AiKnowledge $aiKnowledge): RedirectResponse
    {
        $aiKnowledge->delete();

        return redirect()
            ->route('backoffice.ai-knowledge.index')
            ->with('success', 'Pengetahuan AI telah berhasil dihapus.');
    }

    /**
     * Toggle the active status of a knowledge item.
     */
    public function toggleActive(Request $request, AiKnowledge $aiKnowledge): JsonResponse|RedirectResponse
    {
        $aiKnowledge->update([
            'is_active' => !$aiKnowledge->is_active,
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'is_active' => $aiKnowledge->is_active,
                'message' => $aiKnowledge->is_active ? 'Pengetahuan diaktifkan.' : 'Pengetahuan dinonaktifkan.',
            ]);
        }

        return back()->with('success', $aiKnowledge->is_active ? 'Pengetahuan diaktifkan.' : 'Pengetahuan dinonaktifkan.');
    }

    /**
     * Simulator & Prompt Inspection Tool.
     */
    public function testPrompt(GeminiChatService $gemini): View
    {
        $compiledInstruction = $gemini->getCompiledSystemInstruction('Bapak / Ibu Pengunjung');
        $activeCount = AiKnowledge::where('is_active', true)->count();

        return view('backoffice.ai-knowledge.test', compact('compiledInstruction', 'activeCount'));
    }

    /**
     * Ask a test question to Gemini using current active memory.
     */
    public function askTest(Request $request, GeminiChatService $gemini): JsonResponse
    {
        $request->validate([
            'question' => 'required|string|max:1000',
            'visitor_name' => 'nullable|string|max:100',
        ]);

        $question = $request->input('question');
        $visitorName = $request->input('visitor_name', 'Pengunjung Proyek') ?: 'Pengunjung Proyek';

        $result = $gemini->simulateReply($question, $visitorName);

        return response()->json($result);
    }
}
