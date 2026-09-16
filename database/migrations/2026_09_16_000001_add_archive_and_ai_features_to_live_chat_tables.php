<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('live_chat_sessions', function (Blueprint $table) {
            $table->boolean('is_archived')->default(false)->index()->after('status');
            $table->timestamp('archived_at')->nullable()->after('is_archived');
            $table->boolean('ai_enabled')->default(true)->after('archived_at');
            $table->boolean('needs_human_takeover')->default(false)->after('ai_enabled');
            $table->timestamp('admin_engaged_at')->nullable()->after('needs_human_takeover');
        });

        Schema::table('live_chat_messages', function (Blueprint $table) {
            $table->boolean('is_ai')->default(false)->after('is_read');
        });
    }

    public function down(): void
    {
        Schema::table('live_chat_sessions', function (Blueprint $table) {
            $table->dropColumn([
                'is_archived',
                'archived_at',
                'ai_enabled',
                'needs_human_takeover',
                'admin_engaged_at',
            ]);
        });

        Schema::table('live_chat_messages', function (Blueprint $table) {
            $table->dropColumn(['is_ai']);
        });
    }
};
