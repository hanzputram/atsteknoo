<?php

namespace App\Console\Commands;

use App\Models\AiKnowledge;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\AuditLog;
use App\Models\Brand;
use App\Models\Certificate;
use App\Models\ContactInquiry;
use App\Models\ImportJob;
use App\Models\LiveChatMessage;
use App\Models\LiveChatSession;
use App\Models\MediaAsset;
use App\Models\MediaUsage;
use App\Models\PriceList;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSpecification;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class ResetCleanBackofficeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backoffice:clean-reset {--password=SuperAdmin2026! : Password untuk akun Super Admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus semua data dummy dan inisialisasi hanya 1 akun Super Administrator dengan hak akses penuh';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info("=== MEMULAI PEMBERSIHAN DATA DUMMY & SETUP SUPER ADMIN ATS ===");

        // 1. Truncate / Delete all dummy data tables
        $tablesToClean = [
            'product_specifications',
            'category_product',
            'products',
            'product_categories',
            'projects',
            'project_categories',
            'articles',
            'article_categories',
            'article_tag',
            'tags',
            'contact_inquiries',
            'live_chat_messages',
            'live_chat_sessions',
            'certificates',
            'price_lists',
            'media_usages',
            'media_assets',
            'import_jobs',
            'audit_logs',
        ];

        foreach ($tablesToClean as $table) {
            if (Schema::hasTable($table)) {
                $count = DB::table($table)->count();
                DB::table($table)->delete();
                $this->line(" - Membersihkan tabel '{$table}': {$count} data dihapus.");
            }
        }

        // Clean brands except real authorized brands if any, or wipe all to be 100% clean
        if (Schema::hasTable('brands')) {
            $brandCount = DB::table('brands')->count();
            DB::table('brands')->delete();
            $this->line(" - Membersihkan tabel 'brands': {$brandCount} data dihapus.");
        }

        // 2. Wipe all existing users
        $userCount = User::count();
        User::query()->delete();
        $this->line(" - Membersihkan tabel 'users': {$userCount} akun dihapus.");

        // 3. Create the SINGLE Super Administrator user
        $password = $this->option('password') ?: 'SuperAdmin2026!';

        $superAdmin = User::create([
            'name' => 'Super Administrator ATS',
            'username' => 'superadmin',
            'email' => 'superadmin@atstekno.com',
            'password' => Hash::make($password),
            'role' => 'superadmin',
            'permissions' => ['*'],
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $this->info("\n=== BERHASIL SETUP SINGLE SUPER ADMIN ===");
        $this->table(
            ['Parameter', 'Kredensial'],
            [
                ['Nama Lengkap', $superAdmin->name],
                ['Username', $superAdmin->username],
                ['Alamat Email', $superAdmin->email],
                ['Password', $password],
                ['Peran (Role)', 'superadmin (Super Administrator)'],
                ['Hak Akses (Permissions)', '["*"] - Akses Penuh ke Semua Modul'],
                ['Total Pengguna di Sistem', 'Hanya 1 Akun (Single User)'],
                ['URL Login Backoffice', url('/backoffice/login')],
            ]
        );

        $this->info("Kini Anda dapat login dengan akun di atas dan mendaftarkan user baru dengan role & permission yang fleksibel.");

        return Command::SUCCESS;
    }
}
