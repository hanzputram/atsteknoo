# Audit Awal Repository — PT. Anugerah Tama Sejati (ATS Tekno)

Dokumen ini disusun sesuai instruksi Section 2.2 *Implementation — Halaman Publik dan Backoffice Katalog* sebagai baseline teknis, data, desain, dan infrastruktur sebelum implementasi lanjutan.

---

## 1. Runtime & Environment

| Komponen | Spesifikasi Aktual | Keterangan |
| --- | --- | --- |
| **Framework** | Laravel Framework 13.17 (PHP 8.3+ compatible) | Terpasang via `composer.json` (`laravel/framework: ^13.17`, `laravel/fortify: ^1.37.2`). |
| **PHP CLI** | PHP 8.5.6 (cli) NTS Visual C++ 2022 x64 | Binary aktif pada sistem: `C:\tools\php85\php.exe`. |
| **PHP Extensions** | `bcmath`, `calendar`, `ctype`, `date`, `dom`, `fileinfo`, `filter`, `gd`, `hash`, `iconv`, `json`, `mbstring`, `openssl`, `pcre`, `PDO`, `pdo_sqlite`, `session`, `SimpleXML`, `sqlite3`, `zip`, `zlib`. | `gd` dan `zip` aktif untuk image processing dan XLSX. Koneksi outbound didukung via wrapper `https`. |
| **Database** | SQLite (`database/database.sqlite`) | Driver `sqlite`, file database aktif dan terhubung. |
| **Build Tool & Bundler**| Vite 6.x + `@tailwindcss/vite` 4.x + TypeScript | Asset pipeline terkonfigurasi pada `vite.config.ts`. |
| **Authentication** | Laravel Fortify (`laravel/fortify: ^1.37.2`) | Provider `FortifyServiceProvider` terdaftar di `bootstrap/providers.php`. |
| **Test Runner** | Pest 5.x / PHPUnit | Runner teruji via `php vendor/pestphp/pest/bin/pest` (100% lulus). |

---

## 2. Desain & Kontrak Visual

| Aspek | Acuan Aktual Repository |
| --- | --- |
| **Layout Publik Utama** | `resources/views/app.blade.php` |
| **Komponen Visual Bersama** | `resources/views/components/`: `footer.blade.php`, `language-switcher.blade.php`, `customer-carousel.blade.php`, `curved-walking-text.blade.php`, `our-products.blade.php`, `our-projects-carousel.blade.php`. |
| **Tipografi** | Google Fonts: `Outfit` (headings, branding, badges) dan `Plus Jakarta Sans` (body text, CTA buttons, form inputs). |
| **Palet Warna Utama** | Primary Accent: `#E11D48` (Crimson Rose); Dark Canvas: `#0F172A` (Slate Navy); Neutral Light: `#F8FAFC` & `#FFFFFF`; Border: `#E2E8F0`; Text Gray: `#475569` & `#64748B`. Footer Dark: `#001D34`. |
| **Radius & Elevasi** | Card radius: `16px` – `24px`; Pill buttons: `999px`; Bayangan: `0 10px 28px rgba(0,0,0,0.08)` hingga `0 20px 44px rgba(0,0,0,0.18)`. |
| **Responsivitas & Breakpoints** | Desktop: 1440px (Max container: 1480px, padding 36px 32px); Tablet: 768px – 1120px; Mobile: 360px – 640px (tidak ada horizontal scrollbar). |
| **Sistem Multibahasa (i18n)** | `public/js/ats-i18n.js` dengan toggle segmented pill `[ EN | ID ]`. Bahasa utama default: English (EN); Bahasa sekunder: Bahasa Indonesia (ID). |

---

## 3. Inventarisasi Halaman & Route

| Halaman | URL Aktual / Target | Route Name | Controller / View | Status Saat Ini | Tindakan yang Diperlukan |
| --- | --- | --- | --- | --- | --- |
| **Home** | `/` | `home` | `app.blade.php` | Aktif (desain approved, interaktif) | Pertahankan visual; hubungkan section produk, brand, project, dan artikel ke query database. |
| **Daftar Produk** | `/products` | `products.index` | `ProductController@index` | Baru modal di homepage | Bangun view katalog publik lengkap: search SKU/nama, filter brand & kategori, sorting, pagination 24/halaman, empty state. |
| **Detail Produk** | `/products/{slug}` | `products.show` | `ProductController@show` | Belum ada | Bangun view detail: galeri foto contain, badge brand/kategori, deskripsi HTML ter-sanitasi, tabel spesifikasi teknis dinamis, datasheet PDF, related products, CTA inquiry. **Tanpa harga/stok.** |
| **Kategori Produk** | `/product-categories/{slug}` | `product-categories.show` | `ProductCategoryController@show` | Belum ada | Bangun view listing produk tersaring per kategori dengan subkategori jika ada. |
| **Daftar Brand** | `/brands` | `brands.index` | `BrandController@index` | Baru marquee di hero | Bangun direktori brand partner resmi dengan logo, profil, dan link detail. |
| **Detail Brand** | `/brands/{slug}` | `brands.show` | `BrandController@show` | Belum ada | Profil brand resmi, sertifikat kemitraan, dan produk yang dinaungi. |
| **Daftar Project** | `/projects` | `projects.index` | `ProjectController@index` | Baru 3D carousel | Bangun direktori portofolio proyek lengkap dengan kategori, filter tahun/lokasi, thumbnail. |
| **Detail Project** | `/projects/{slug}` | `projects.show` | `ProjectController@show` | Baru modal ringkas | Bangun halaman detail portofolio: cover, galeri foto instalasi, scope of work, client/lokasi faktual. |
| **Daftar Artikel** | `/articles` | `articles.index` | `ArticleController@index` | Baru anchor link | Bangun listing artikel/blog: thumbnail, kategori, tanggal rilis, excerpt, pagination. |
| **Detail Artikel** | `/articles/{slug}` | `articles.show` | `ArticleController@show` | Belum ada | Layout baca nyaman, WYSIWYG sanitasi, gambar inline responsif, author, tag, artikel terkait. |
| **About Us** | `/about-us` | `about.index` | `PageController@about` | Baru section anchor | Halaman profil perusahaan lengkap: legalitas, sejarah, visi-misi, nilai perusahaan, foto fasilitas. |
| **Contact Us** | `/contact` | `contact.index` | `ContactController@index` | Baru modal & footer | Halaman kontak resmi: Surabaya Head Office, cabang, form inquiry (dengan honeypot & CSRF), peta interaktif. |
| **Error 404 / 403** | `/404`, `/403` | N/A | `resources/views/errors/` | Default generic | Tampilan konsisten dengan tema ATS Tekno, navigasi kembali jelas, status HTTP sesuai. |

---

## 4. Analisis Data & Model

| Area | Model / Tabel | Status | Hubungan & Kebutuhan Tambahan |
| --- | --- | --- | --- |
| **Users & Auth** | `User` (`users`) | Existing (5 migrations) | Tambahkan kolom `role` (`admin`, `editor`), `is_active` (boolean, default true) via migration aditif. |
| **Katalog Produk** | `Product` (`products`), `ProductSpecification` (`product_specifications`), `Brand` (`brands`), `ProductCategory` (`product_categories`) | Baru | Hubungan many-to-many produk-kategori, belongsTo brand, hasMany spesifikasi. SKU normalized uppercase unique. **Tidak ada kolom harga/stok.** |
| **Portofolio Project** | `Project` (`projects`), `ProjectCategory` (`project_categories`) | Baru | BelongsTo project category, relasi media galeri, relasi produk opsional. |
| **Editorial Artikel** | `Article` (`articles`), `ArticleCategory` (`article_categories`), `Tag` (`tags`) | Baru | BelongsTo kategori artikel, belongsToMany tags, belongsTo author. Kontrak publik: `status = published AND published_at <= NOW()`. |
| **Halaman & Konten** | `Page` (`pages`), `SiteSetting` (`site_settings`), `ContactInquiry` (`contact_inquiries`) | Baru | Menyimpan about us terstruktur, settings (logo, kontak resmi, social links), dan inbox inquiry form kontak. |
| **Media Terpusat** | `MediaAsset` (`media_assets`), `MediaUsage` (`media_usages`) | Baru | Menyimpan berkas gambar (JPEG/PNG/WEBP) dan PDF datasheet. Pengambilan publik hanya untuk media yang berelasi ke konten berstatus `published`. |
| **Impor & Operasional** | `ImportJob` (`import_jobs`), `AuditLog` (`audit_logs`), `UrlRedirect` (`url_redirects`) | Baru | Riwayat import Excel, checkpoint per SKU, penanganan konflik revisi `lock_version`, 301 redirects untuk slug yang diubah. |

---

## 5. Backoffice & Keamanan

- **Prefix URL**: `/backoffice`
- **Autentikasi**: Server-side session authentication berbasis email + password, rate limiting 5 percobaan/menit, proteksi session fixation (`regenerate()`), proteksi CSRF di seluruh mutasi session.
- **Otorisasi Role**:
  - `Admin`: Hak penuh, soft delete/restore record utama, manajemen user/role, konfigurasi settings/halaman, hapus media tak terpakai.
  - `Editor`: CRUD produk, project, artikel, brand, kategori, tag, media konten, import/export produk. Tidak dapat mengarsipkan/menghapus record utama atau mengubah akun user/settings.
- **Admin Bootstrap Command**: `php artisan app:create-admin` (interaktif atau via env) untuk setup akun awal aman tanpa hardcode credential.
- **Sanitasi Konten**: Sanitizer HTML server-side allowlist (heading h2-h4, p, ul, ol, li, strong, em, table, a, img aman) menolak tag script, onload/onerror handler, iframe sembarangan, executable URL.
- **SSRF & Google Drive Adapter**: `DriveDownloadAdapter` membatasi download hanya ke host Google Drive terverifikasi (`drive.google.com`, `docs.google.com`), memblokir redirect ke loopback (`127.0.0.1`, `::1`), link-local/private IP (`10.0.0.0/8`, `192.168.0.0/16`, `172.16.0.0/12`), dan cloud metadata (`169.254.169.254`).

---

## 6. Infrastruktur & Cara Menjalankan

- **Web Server**: `php artisan serve` (port 8000).
- **Vite Bundler**: `npm run dev` untuk hot module replacement.
- **Queue Worker**: `php artisan queue:work --tries=3` (didukung SQLite `jobs` table yang sudah ada pada migration `0001_01_01_000002_create_jobs_table.php`).
- **Storage**: `php artisan storage:link` untuk public asset preview terotorisasi.
- **Perintah Pengujian**: `php vendor/pestphp/pest/bin/pest` untuk eksekusi test suite otomatis.
