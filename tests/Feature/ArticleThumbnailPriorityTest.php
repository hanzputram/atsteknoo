<?php

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\MediaAsset;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');

    $this->admin = User::create([
        'name' => 'Admin Test',
        'email' => 'admin_article@test.com',
        'password' => Hash::make('Password123!'),
        'role' => 'admin',
        'is_active' => true,
    ]);

    $this->category = ArticleCategory::create([
        'code' => 'TECH',
        'name' => 'Technical Engineering',
        'slug' => 'technical-engineering',
        'is_active' => true,
    ]);
});

test('uploaded thumbnail has higher priority than legacy image_url in getThumbnailUrlAttribute', function () {
    $media = MediaAsset::create([
        'disk' => 'public',
        'file_path' => 'media/images/sample.webp',
        'original_name' => 'sample.webp',
        'mime_type' => 'image/webp',
        'file_size' => 1024,
        'checksum' => hash('sha256', 'sample_content'),
        'media_type' => 'image',
    ]);

    $article = Article::create([
        'title' => 'Sample Switchboard Engineering Guide',
        'slug' => 'sample-switchboard-guide',
        'content_html' => '<p>Test content</p>',
        'thumbnail_id' => $media->id,
        'image_url' => 'https://atstekno.com/wp-content/uploads/2025/09/2.png',
        'category_id' => $this->category->id,
        'status' => 'published',
        'published_at' => now(),
    ]);

    // The thumbnail_url must return the media view route, NOT the legacy dead wp-content URL!
    expect($article->thumbnail_url)->toBe(route('media.view', $media->id));
});

test('legacy non-existent wp-content image_url falls back to default engineering image', function () {
    $article = Article::create([
        'title' => 'Article with dead legacy WP image',
        'slug' => 'article-with-dead-legacy-wp-image',
        'content_html' => '<p>Test content</p>',
        'thumbnail_id' => null,
        'image_url' => 'https://atstekno.com/wp-content/uploads/2021/08/non-existent.jpg',
        'category_id' => $this->category->id,
        'status' => 'published',
        'published_at' => now(),
    ]);

    expect($article->thumbnail_url)->toBe(asset('images/projects/project-1-substation.webp'));
});

test('backoffice update with new thumbnail clears legacy image_url', function () {
    $article = Article::create([
        'title' => 'Article before update',
        'slug' => 'article-before-update',
        'content_html' => '<p>Initial content</p>',
        'thumbnail_id' => null,
        'image_url' => 'https://atstekno.com/wp-content/uploads/2025/09/2.png',
        'category_id' => $this->category->id,
        'status' => 'published',
        'published_at' => now(),
    ]);

    $file = UploadedFile::fake()->image('thumbnail.jpg', 600, 400);

    $response = $this->actingAs($this->admin)->put(route('backoffice.articles.update', $article->id), [
        'title' => 'Article after update',
        'category_id' => $this->category->id,
        'content_html' => '<p>Updated content</p>',
        'status' => 'published',
        'thumbnail' => $file,
    ]);

    $response->assertRedirect(route('backoffice.articles.index'));

    $article->refresh();
    expect($article->thumbnail_id)->not->toBeNull();
    expect($article->image_url)->toBeNull();
    expect($article->thumbnail_url)->toBe(route('media.view', $article->thumbnail_id));
});
