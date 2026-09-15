<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Adjust existing UTC chat timestamps by +7 hours to align with Asia/Jakarta (WIB)
        $messages = DB::table('live_chat_messages')->get();
        foreach ($messages as $msg) {
            if ($msg->created_at) {
                DB::table('live_chat_messages')
                    ->where('id', $msg->id)
                    ->update([
                        'created_at' => Carbon::parse($msg->created_at)->addHours(7)->format('Y-m-d H:i:s'),
                        'updated_at' => $msg->updated_at ? Carbon::parse($msg->updated_at)->addHours(7)->format('Y-m-d H:i:s') : null,
                    ]);
            }
        }

        $sessions = DB::table('live_chat_sessions')->get();
        foreach ($sessions as $session) {
            $updates = [];
            if ($session->created_at) {
                $updates['created_at'] = Carbon::parse($session->created_at)->addHours(7)->format('Y-m-d H:i:s');
            }
            if ($session->updated_at) {
                $updates['updated_at'] = Carbon::parse($session->updated_at)->addHours(7)->format('Y-m-d H:i:s');
            }
            if ($session->last_message_at) {
                $updates['last_message_at'] = Carbon::parse($session->last_message_at)->addHours(7)->format('Y-m-d H:i:s');
            }
            if (!empty($updates)) {
                DB::table('live_chat_sessions')->where('id', $session->id)->update($updates);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $messages = DB::table('live_chat_messages')->get();
        foreach ($messages as $msg) {
            if ($msg->created_at) {
                DB::table('live_chat_messages')
                    ->where('id', $msg->id)
                    ->update([
                        'created_at' => Carbon::parse($msg->created_at)->subHours(7)->format('Y-m-d H:i:s'),
                        'updated_at' => $msg->updated_at ? Carbon::parse($msg->updated_at)->subHours(7)->format('Y-m-d H:i:s') : null,
                    ]);
            }
        }

        $sessions = DB::table('live_chat_sessions')->get();
        foreach ($sessions as $session) {
            $updates = [];
            if ($session->created_at) {
                $updates['created_at'] = Carbon::parse($session->created_at)->subHours(7)->format('Y-m-d H:i:s');
            }
            if ($session->updated_at) {
                $updates['updated_at'] = Carbon::parse($session->updated_at)->subHours(7)->format('Y-m-d H:i:s');
            }
            if ($session->last_message_at) {
                $updates['last_message_at'] = Carbon::parse($session->last_message_at)->subHours(7)->format('Y-m-d H:i:s');
            }
            if (!empty($updates)) {
                DB::table('live_chat_sessions')->where('id', $session->id)->update($updates);
            }
        }
    }
};
