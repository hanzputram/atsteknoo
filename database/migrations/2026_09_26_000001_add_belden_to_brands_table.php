<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $exists = DB::table('brands')->where('slug', 'belden')->orWhere('code', 'BELDEN')->exists();
        if (!$exists) {
            DB::table('brands')->insert([
                'code' => 'BELDEN',
                'name' => 'Belden',
                'slug' => 'belden',
                'description_html' => '<p>Supplier resmi kabel industri, kabel instrumen, dan jaringan komunikasi Belden berkualitas tinggi untuk otomasi pabrik dan infrastruktur kelistrikan.</p>',
                'website_url' => 'https://www.belden.com',
                'sort_order' => 25,
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('brands')->where('slug', 'belden')->delete();
    }
};
