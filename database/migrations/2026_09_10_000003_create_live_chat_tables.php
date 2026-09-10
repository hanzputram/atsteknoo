<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('live_chat_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_token')->unique()->index();
            $table->string('visitor_name')->default('Tamu');
            $table->string('visitor_contact')->nullable();
            $table->string('status')->default('unread'); // unread, active, closed
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();
        });

        Schema::create('live_chat_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_id')->constrained('live_chat_sessions')->cascadeOnDelete();
            $table->enum('sender', ['visitor', 'admin'])->default('visitor');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->foreignId('admin_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('live_chat_messages');
        Schema::dropIfExists('live_chat_sessions');
    }
};
