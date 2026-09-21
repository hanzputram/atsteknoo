<?php

namespace App\Http\Controllers;

use App\Models\MediaAsset;
use App\Models\Product;
use App\Models\Project;
use App\Models\Article;
use App\Models\Brand;
use App\Models\Page;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MediaDeliveryController extends Controller
{
    /**
     * Serve media file with access control checking.
     */
    public function view(Request $request, int $id)
    {
        $media = MediaAsset::find($id);
        if (!$media) {
            abort(404, 'File media tidak ditemukan.');
        }

        // 1. If user is logged in as Admin or Editor, grant access
        $user = $request->user();
        if ($user && $user->canAccessBackoffice()) {
            return $this->serveFile($media);
        }

        // 2. Check if the media is attached to any currently published entity
        if ($this->isMediaPubliclyAccessible($media)) {
            return $this->serveFile($media);
        }

        abort(403, 'Akses file terbatas pada konten publik.');
    }

    /**
     * Check if media is referenced by any published record.
     */
    protected function isMediaPubliclyAccessible(MediaAsset $media): bool
    {
        // Check Product main image or datasheet
        $isProductPublished = Product::published()
            ->where(function ($q) use ($media) {
                $q->where('main_image_id', $media->id)
                  ->orWhere('datasheet_id', $media->id);
            })->exists();

        if ($isProductPublished) {
            return true;
        }

        // Check Brand logo
        $isBrandActive = Brand::active()->where('logo_id', $media->id)->exists();
        if ($isBrandActive) {
            return true;
        }

        // Check Product Category image
        $isCategoryActive = ProductCategory::active()->where('image_id', $media->id)->exists();
        if ($isCategoryActive) {
            return true;
        }

        // Check Project cover
        $isProjectPublished = Project::published()->where('cover_image_id', $media->id)->exists();
        if ($isProjectPublished) {
            return true;
        }

        // Check Article thumbnail or embedded in Article content_html
        $isArticlePublished = Article::published()
            ->where(function ($q) use ($media) {
                $q->where('thumbnail_id', $media->id)
                  ->orWhere('content_html', 'like', "%/media/{$media->id}/%")
                  ->orWhere('content_html', 'like', "%{$media->file_path}%");
            })->exists();

        if ($isArticlePublished) {
            return true;
        }

        // Check Page content
        $isPagePublished = Page::where('is_active', true)
            ->where(function ($q) use ($media) {
                $q->where('content_html', 'like', "%/media/{$media->id}/%")
                  ->orWhere('content_html', 'like', "%{$media->file_path}%");
            })->exists();

        if ($isPagePublished) {
            return true;
        }

        // Check gallery usages
        $usages = $media->usages()->get();
        foreach ($usages as $usage) {
            $modelClass = $usage->model_type;
            if (!class_exists($modelClass)) {
                continue;
            }

            $model = $modelClass::find($usage->model_id);
            if (!$model) {
                continue;
            }

            if (method_exists($model, 'isPublished') && $model->isPublished()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Serve file binary response.
     */
    protected function serveFile(MediaAsset $media): BinaryFileResponse
    {
        $disk = Storage::disk($media->disk);
        if (!$disk->exists($media->file_path)) {
            abort(404, 'File media tidak ditemukan di storage.');
        }

        $fullPath = $disk->path($media->file_path);

        return response()->file($fullPath, [
            'Content-Type' => $media->mime_type,
            'Content-Disposition' => 'inline; filename="' . addslashes($media->original_name) . '"',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
