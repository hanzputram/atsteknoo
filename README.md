# PT. Anugerah Tama Sejati — Company Profile & Industrial Catalog

Website profil perusahaan, katalog produk elektrikal industri, portofolio rekayasa panel, dan publikasi artikel teknis resmi **PT. Anugerah Tama Sejati**.

Dilengkapi sistem Backoffice terproteksi penuh (*session-based auth & role-based authorization*) dan Import Center massal berbasis spreadsheet Excel (.xlsx) dengan integrasi pengunduhan gambar dari Google Drive.

---

## 1. Persyaratan Lingkungan (System Requirements)

- **PHP:** Versi 8.2 atau lebih baru (Didukung dan terverifikasi pada PHP 8.5.6)
- **Ekstensi PHP Wajib:** `pdo_sqlite` (atau `pdo_mysql`), `mbstring`, `xml`, `dom`, `fileinfo`, `gd` / `imagick`, `zip`
- **Composer:** Versi 2.x
- **Database:** SQLite (default lokal di `database/database.sqlite`) atau MySQL / PostgreSQL

---

## 2. Panduan Instalasi & Menjalankan Aplikasi

### Langkah 1: Clone Repositori & Install Dependencies
```bash
composer install
```

### Langkah 2: Konfigurasi Environment
Salin file `.env.example` menjadi `.env` dan buat encryption key:
```bash
cp .env.example .env
php artisan key:generate
```

### Langkah 3: Migrasi Database & Seeding Data Awal
Jalankan migrasi tabel katalog dan seed master data awal (brand resmi, kategori, produk contoh dengan spesifikasi teknik lengkap, proyek, artikel, dan profil perusahaan):
```bash
php artisan migrate
php artisan db:seed --class=InitialCatalogSeeder
```

### Langkah 4: Tautkan Storage Simbolik
```bash
php artisan storage:link
```

### Langkah 5: Buat Akun Administrator Pertama
Gunakan command CLI interaktif untuk membuat akun staf Admin:
```bash
php artisan app:create-admin
```
Masukkan username (misal: `superats888`), email, nama, dan kata sandi aman (minimal 12 karakter).

### Langkah 6: Jalankan Server Lokal
```bash
php artisan serve
```
Aplikasi kini aktif di `http://127.0.0.1:8000`.

---

## 3. Peta Rute & Halaman Penting

### 3.1 Halaman Publik
- **Beranda (Landing Page):** `http://127.0.0.1:8000/`
- **Katalog Produk:** `http://127.0.0.1:8000/products`
- **Detail Produk & Spesifikasi:** `http://127.0.0.1:8000/products/{slug}`
- **Kategori Produk:** `http://127.0.0.1:8000/product-categories/{slug}`
- **Daftar Brand & Prinsipal:** `http://127.0.0.1:8000/brands`
- **Detail Brand & Produk Terkait:** `http://127.0.0.1:8000/brands/{slug}`
- **Portofolio Proyek:** `http://127.0.0.1:8000/projects`
- **Detail Proyek Rekayasa:** `http://127.0.0.1:8000/projects/{slug}`
- **Artikel & Berita Teknik:** `http://127.0.0.1:8000/articles`
- **Detail Bacaan Artikel:** `http://127.0.0.1:8000/articles/{slug}`
- **Profil Perusahaan (About Us):** `http://127.0.0.1:8000/about-us`
- **Hubungi Kami & Form BoQ:** `http://127.0.0.1:8000/contact`

### 3.2 Area Backoffice (Wajib Login)
- **Login Admin/Editor:** `http://127.0.0.1:8000/backoffice/login`
- **Dashboard Statistik:** `http://127.0.0.1:8000/backoffice`
- **Manajemen Produk:** `http://127.0.0.1:8000/backoffice/products`
- **Import Center (.xlsx & Google Drive):** `http://127.0.0.1:8000/backoffice/import-products`
- **Pengaturan Website & Kontak:** `http://127.0.0.1:8000/backoffice/settings`
- **Kotak Masuk Pesan Pelanggan:** `http://127.0.0.1:8000/backoffice/inquiries`
- **Manajemen Staf & Akses:** `http://127.0.0.1:8000/backoffice/users`

---

## 4. Pengujian Otomatis (Automated Testing)

Jalankan test suite Pest untuk memverifikasi kontrak fungsional, otorisasi peran, validasi SKU teks, pencegahan SSRF Google Drive, sanitasi HTML, dan kebijakan non-transaksional:
```bash
php vendor/pestphp/pest/bin/pest
```

---

## 5. Dokumentasi Teknis Terkait

Dokumentasi terperinci tersedia pada direktori `docs/`:
1. [Audit Awal Repositori](docs/project-audit.md) — Hasil inventarisasi arsitektur, runtime, dan layout.
2. [Panduan Backoffice](docs/backoffice-guide.md) — Panduan hak akses Admin & Editor dan pengelolaan seluruh modul.
3. [Panduan Impor Produk Excel](docs/product-import-guide.md) — Spesifikasi format XLSX, token `__CLEAR__`, integrasi tautan Google Drive, dan kode error.
4. [Laporan Verifikasi Penerimaan](docs/verification-report.md) — Matriks pengujian menyeluruh terhadap kriteria T01 sampai T35.
