<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Fortify\Contracts\PasskeyUser;
use Laravel\Fortify\PasskeyAuthenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;

/**
 * @property int $id
 * @property string $name
 * @property string|null $username
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property Carbon|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['name', 'username', 'email', 'password', 'role', 'permissions', 'is_active'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable implements PasskeyUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, PasskeyAuthenticatable, TwoFactorAuthenticatable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
            'is_active' => 'boolean',
            'permissions' => 'array',
        ];
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, ['superadmin', 'admin']);
    }

    public function isEditor(): bool
    {
        return in_array($this->role, ['superadmin', 'editor']);
    }

    public function isCustomerSupport(): bool
    {
        return in_array($this->role, ['superadmin', 'cs', 'support']);
    }

    public function isCs(): bool
    {
        return $this->isCustomerSupport();
    }

    /**
     * Check if user has permission to access a specific module.
     */
    public function hasPermission(string $module): bool
    {
        if (!$this->is_active) {
            return false;
        }

        // Superadmin has full omnipotent access to all modules
        if ($this->role === 'superadmin') {
            return true;
        }

        $perms = $this->permissions ?? self::getDefaultPermissionsForRole($this->role);

        if (!is_array($perms)) {
            $perms = [];
        }

        return in_array('*', $perms) || in_array($module, $perms);
    }

    /**
     * Check if user has permission for any of given modules.
     */
    public function hasAnyPermission(array $modules): bool
    {
        foreach ($modules as $module) {
            if ($this->hasPermission($module)) {
                return true;
            }
        }

        return false;
    }

    public function canManageCatalog(): bool
    {
        return $this->hasAnyPermission([
            'products', 'product_categories', 'brands', 'import_products',
            'certificates', 'projects', 'articles', 'pages', 'media_library'
        ]);
    }

    public function canManageInbox(): bool
    {
        return $this->hasAnyPermission(['live_chats', 'inquiries', 'ai_knowledge']);
    }

    public function getRoleLabelAttribute(): string
    {
        return match($this->role) {
            'superadmin' => 'Super Administrator',
            'admin' => 'Administrator',
            'editor' => 'Editor',
            'cs', 'support' => 'Customer Support',
            'custom' => 'Staf Kustom',
            default => ucfirst($this->role ?? 'Staf'),
        };
    }

    public function canAccessBackoffice(): bool
    {
        return (bool) $this->is_active && in_array($this->role, ['superadmin', 'admin', 'editor', 'cs', 'support', 'custom']);
    }

    /**
     * Default permission keys for each preset role.
     */
    public static function getDefaultPermissionsForRole(?string $role): array
    {
        return match ($role) {
            'superadmin' => ['*'],
            'admin' => [
                'dashboard', 'products', 'product_categories', 'brands', 'import_products',
                'certificates', 'projects', 'articles', 'pages', 'media_library',
                'live_chats', 'inquiries', 'ai_knowledge', 'settings', 'users'
            ],
            'editor' => [
                'dashboard', 'products', 'product_categories', 'brands', 'import_products',
                'certificates', 'projects', 'articles', 'pages', 'media_library'
            ],
            'cs', 'support' => [
                'dashboard', 'live_chats', 'inquiries', 'ai_knowledge'
            ],
            default => ['dashboard'],
        };
    }

    /**
     * Centralized dictionary of all backoffice modules and their metadata.
     */
    public static function availableModules(): array
    {
        return [
            'katalog' => [
                'label' => 'Katalog Produk & Data Master',
                'modules' => [
                    'products' => [
                        'label' => 'Master Produk',
                        'desc' => 'Tambah, edit, hapus data produk, SKU, spesifikasi & gambar',
                    ],
                    'product_categories' => [
                        'label' => 'Kategori Produk',
                        'desc' => 'Kelola hierarki & taksonomi kategori produk kelistrikan',
                    ],
                    'brands' => [
                        'label' => 'Brand Resmi',
                        'desc' => 'Kelola brand resmi, profil prinsipal distributor dan logo',
                    ],
                    'import_products' => [
                        'label' => 'Import Center (Excel)',
                        'desc' => 'Import dan export massal katalog produk via spreadsheet',
                    ],
                    'certificates' => [
                        'label' => 'Master Sertifikat',
                        'desc' => 'Kelola sertifikat keaslian produk dan lisensi distributor',
                    ],
                ],
            ],
            'konten' => [
                'label' => 'Portofolio & Publikasi Konten',
                'modules' => [
                    'projects' => [
                        'label' => 'Project Portofolio',
                        'desc' => 'Kelola dokumentasi portofolio proyek panel & pengadaan',
                    ],
                    'articles' => [
                        'label' => 'Artikel & Panduan Edukasi',
                        'desc' => 'Menulis artikel teknis, berita industri dan panduan elektrikal',
                    ],
                    'pages' => [
                        'label' => 'Halaman Perusahaan',
                        'desc' => 'Edit teks dan konten halaman statis (Tentang Kami, dll.)',
                    ],
                    'media_library' => [
                        'label' => 'Media Library',
                        'desc' => 'Unggah dan atur repositori gambar serta file dokumen PDF',
                    ],
                ],
            ],
            'pelayanan' => [
                'label' => 'Layanan Pelanggan & Interaksi',
                'modules' => [
                    'live_chats' => [
                        'label' => 'Live Chat Center',
                        'desc' => 'Terima pesan, balas chat pengunjung website realtime',
                    ],
                    'inquiries' => [
                        'label' => 'Pesan Masuk (RFQ & Kontak)',
                        'desc' => 'Lihat dan tindak lanjuti pesan kontak dan formulir penawaran',
                    ],
                    'ai_knowledge' => [
                        'label' => 'Pengetahuan & Memori AI',
                        'desc' => 'Pelatihan memori bot AI dan data FAQ respon cepat',
                    ],
                ],
            ],
            'sistem' => [
                'label' => 'Administrasi & Konfigurasi Sistem',
                'modules' => [
                    'settings' => [
                        'label' => 'Pengaturan Website & SEO',
                        'desc' => 'Konfigurasi umum, nomor WhatsApp, email, dan meta tag',
                    ],
                    'users' => [
                        'label' => 'Manajemen Pengguna & Role',
                        'desc' => 'Tambah staf baru, atur role, dan tentukan izin permission modul',
                    ],
                ],
            ],
        ];
    }
}
