<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('price_lists', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->string('brand_name', 100);
            $table->string('edition_year', 32)->nullable();
            $table->string('category', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail_url', 500)->nullable();
            $table->string('view_url', 500);
            $table->string('download_url', 500)->nullable();
            $table->string('file_size', 50)->default('PDF Document');
            $table->string('tax_note', 100)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_lists');
    }
};
