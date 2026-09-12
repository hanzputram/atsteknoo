<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\MediaAsset;
use App\Services\MediaService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaLibraryController extends Controller
{
    /**
     * Get paginated media assets for the "Add Media" modal.
     */
    public function index(Request $request): JsonResponse
    {
        $search = $request->get('search');

        $query = MediaAsset::where('media_type', 'image')->latest('id');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('original_filename', 'like', "%{$search}%")
                  ->orWhere('alt_text', 'like', "%{$search}%");
            });
        }

        $media = $query->paginate(24);

        $items = $media->getCollection()->map(function ($item) {
            $url = Storage::disk($item->disk)->exists($item->file_path)
                ? asset('storage/' . $item->file_path)
                : route('media.view', $item->id);

            return [
                'id' => $item->id,
                'filename' => $item->original_filename,
                'alt_text' => $item->alt_text ?: $item->original_filename,
                'url' => $url,
                'width' => $item->width,
                'height' => $item->height,
                'size_human' => $item->file_size ? round($item->file_size / 1024, 1) . ' KB' : 'N/A',
                'created_at' => $item->created_at ? $item->created_at->format('d M Y') : '-',
            ];
        });

        return response()->json([
            'items' => $items,
            'current_page' => $media->currentPage(),
            'last_page' => $media->lastPage(),
            'total' => $media->total(),
        ]);
    }

    /**
     * Upload an image directly from the WYSIWYG modal or paste/drag-and-drop.
     */
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'nullable|file|image|mimes:jpeg,png,webp,gif|max:10240',
            'image' => 'nullable|file|image|mimes:jpeg,png,webp,gif|max:10240',
        ]);

        $file = $request->file('file') ?? $request->file('image');

        if (!$file) {
            return response()->json([
                'error' => 'Berkas gambar tidak ditemukan dalam permintaan unggah.',
            ], 422);
        }

        try {
            $media = MediaService::storeUpload($file, 'image', $request->user()?->id);

            $url = Storage::disk($media->disk)->exists($media->file_path)
                ? asset('storage/' . $media->file_path)
                : route('media.view', $media->id);

            return response()->json([
                'location' => $url, // TinyMCE standard format
                'url' => $url,
                'id' => $media->id,
                'filename' => $media->original_filename,
                'alt_text' => $media->alt_text ?: $media->original_filename,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 422);
        }
    }
}
