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
        Schema::table('live_chat_sessions', function (Blueprint $table) {
            $table->timestamp('visitor_typing_at')->nullable()->after('last_message_at');
            $table->timestamp('admin_typing_at')->nullable()->after('visitor_typing_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('live_chat_sessions', function (Blueprint $table) {
            $table->dropColumn(['visitor_typing_at', 'admin_typing_at']);
        });
    }
};
