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
        // 1. Add click counter & last clicked timestamp to products table
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('listrikonline_clicks')->default(0)->after('sort_order');
            $table->timestamp('last_clicked_at')->nullable()->after('listrikonline_clicks');

            $table->index('listrikonline_clicks');
            $table->index('last_clicked_at');
        });

        // 2. Create detailed click audit logs table
        Schema::create('listrikonline_click_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('sku', 100)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('referer')->nullable();
            $table->timestamp('created_at')->nullable()->index();

            $table->index(['product_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listrikonline_click_logs');

        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['listrikonline_clicks']);
            $table->dropIndex(['last_clicked_at']);
            $table->dropColumn(['listrikonline_clicks', 'last_clicked_at']);
        });
    }
};
