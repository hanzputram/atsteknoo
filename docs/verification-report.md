# Laporan Verifikasi Kriteria Penerimaan (Verification Report)

Laporan hasil pengujian komprehensif implementasi Halaman Publik, Backoffice Katalog, dan Sistem Impor Massal Produk Excel PT. Anugerah Tama Sejati.

**Lingkungan Pengujian:**
- **Sistem Operasi:** Windows 11
- **Runtime:** PHP 8.5.6 (CLI & Built-in Web Server)
- **Database:** SQLite 3 (Production File: `database/database.sqlite`, Automated Test: In-Memory `:memory:`)
- **Test Framework:** Pest PHP 3.8.5 (`php vendor/pestphp/pest/bin/pest`)
- **Dependency Utama:** PhpOffice/PhpSpreadsheet 5.9.0, Tailwind CSS, Swiper 11, DOMDocument XML Sanitizer

---

## 1. Matriks Kriteria Pengujian Wajib (T01 – T35)

| ID | Skenario Pengujian | Status | Metode Uji | Catatan & Bukti Verifikasi |
| :--- | :--- | :---: | :--- | :--- |
| **T01** | Buka semua halaman publik dari navbar/footer/CTA | **PASS** | Automated Pest & Browser | Route `/`, `/products`, `/products/{slug}`, `/product-categories/{slug}`, `/brands`, `/brands/{slug}`, `/projects`, `/projects/{slug}`, `/articles`, `/articles/{slug}`, `/about-us`, `/contact` mengembalikan status 200 OK tanpa dead link. |
| **T02** | Uji konsistensi homepage sebelum/sesudah pada 360, 768, dan 1440 px | **PASS** | Visual Inspection & CSS Check | Identitas visual `app.blade.php`, font Outfit & Plus Jakarta Sans, card hover effect, dan skyline footer `#001D34` tetap konsisten tanpa horizontal overflow. |
| **T03** | Akses tamu (guest) ke dashboard, upload, export, report, dan halaman admin | **PASS** | Automated Pest Test | Request HTML diarahkan ke `/backoffice/login`, request API tanpa sesi ditolak dengan 401/403. File media draft tidak bocor ke publik. |
| **T04** | Otorisasi server-side peran Editor vs Admin | **PASS** | Automated Pest Test | Akun peran Editor mengakses `/backoffice/settings` atau `/backoffice/users` menghasilkan HTTP 403 Forbidden secara server-side. |
| **T05** | Login gagal berulang (rate limiting), login sukses regenerasi sesi, dan logout | **PASS** | Automated Pest Test | 5 kali login gagal menghasilkan pemblokiran rate limit (*Too Many Attempts*). Login sukses meregenerasi session ID; logout POST mengakhiri sesi dan token CSRF. |
| **T06** | Mutasi sesi tanpa token CSRF | **PASS** | Laravel Web Middleware | Seluruh form mutasi dilindungi token `@csrf`. Request tanpa token ditolak dengan HTTP 419 Page Expired. |
| **T07** | Nonaktifkan akun dan proteksi Admin aktif terakhir | **PASS** | Unit / Controller Test | Akun `is_active = false` ditolak saat autentikasi. Menghapus akun diri sendiri atau Admin terakhir dicegah oleh sistem. |
| **T08** | Buat/perbarui produk via form, publish, dan buka detail publik | **PASS** | Automated Pest Test | Form produk menyimpan SKU, nama, deskripsi disanitasi, kategori, brand, dan spesifikasi repeater teknis; tampil lengkap di `/products/{slug}`. |
| **T09** | Uji injeksi script/XSS pada konten WYSIWYG | **PASS** | Automated Pest Test | `HtmlSanitizerService` membersihkan tag `<script>`, atribut `onclick`, dan URI `javascript:`. Tag semantik (`<h2>`, `<p>`, `<ul>`) dipertahankan aman. |
| **T10** | Buat artikel dengan thumbnail, alt text, dan tag | **PASS** | Automated Pest Test | Form artikel mendukung upload thumbnail, H1 tunggal dari judul, relasi tag banyak, dan metadata SEO. |
| **T11** | Penjadwalan artikel di masa depan | **PASS** | Automated Pest Test | Artikel dengan `published_at` di masa depan tidak dapat dibuka tamu publik (HTTP 404) dan tidak muncul di daftar `/articles`. |
| **T12** | Buat proyek, brand, kategori, dan perubahan settings | **PASS** | Automated Pest Test | CRUD portofolio proyek dan pengaturan website terhubung langsung ke footer dan halaman publik yang relevan. |
| **T13** | Akses produk berstatus draft atau archived | **PASS** | Automated Pest Test | Query publik menyertakan scope `status = published AND published_at <= now()`. Konten draft/arsip tidak bocor lewat pencarian publik. |
| **T14** | Format SKU teks `000123`, `FORT-AB-001`, dan prefix | **PASS** | Automated Pest Test | `Product::normalizeSku` mempertahankan angka nol di depan dan tanda hubung secara persis. Sel numerik Excel ditolak dengan petunjuk Text format. |
| **T15** | Deteksi dua SKU identik dalam satu file impor | **PASS** | Automated Pest Test | Importer menandai kedua baris sebagai duplikat konflik (`DUPLICATE_SKU_IN_FILE`); tidak ada sistem *last-row-wins* yang menimpa diam-diam. |
| **T16** | Mode impor: Create only, Update only, dan Upsert | **PASS** | Automated Pest Test | `executeUnit` mematuhi aturan mode: membuat record baru, memperbarui yang sudah ada, atau menolak jika SKU tidak sesuai mode. |
| **T17** | Update dengan sel kosong dan token `__CLEAR__` | **PASS** | Automated Pest Test | Sel kosong mempertahankan nilai lama database. Token `__CLEAR__` menghapus nilai field opsional tanpa merusak field wajib. |
| **T18** | Validasi kode brand / kategori salah pada Excel | **PASS** | Automated Pest Test | Kode master yang tidak cocok menghasilkan laporan error `BRAND_NOT_FOUND` / `CATEGORY_NOT_FOUND` tanpa membuat data palsu / typo. |
| **T19** | Impor gambar dari tautan Google Drive publik | **PASS** | Adapter Integration Test | `DriveDownloadAdapter` mengunduh gambar publik, memverifikasi byte/MIME, menyimpan original privat, dan men-generate thumbnail web. |
| **T20** | Penanganan tautan Drive privat, 404, atau file rusak | **PASS** | Adapter Unit Test | Error dibedakan secara konkret (`DRIVE_ACCESS_DENIED`, `DRIVE_FILE_NOT_FOUND`, `INVALID_IMAGE_CONTENT`) tanpa merusak record produk lama. |
| **T21** | Pencegahan SSRF (Server-Side Request Forgery) | **PASS** | Automated Pest Test | URL loopback (`127.0.0.1`), metadata server (`169.254.169.254`), dan IP privat (`10.x`, `192.168.x`) diblokir oleh adapter sebelum koneksi. |
| **T22** | Penolakan formula berbahaya dalam sel XLSX | **PASS** | Importer Security Check | Sel Excel dibaca murni raw value/text, formula `=HYPERLINK()` atau formula eksternal tidak dievaluasi. |
| **T23** | Preview rencana impor sebelum konfirmasi eksekusi | **PASS** | Integration Test | Mengunggah file hanya membuat job staging dan rencana di database; tidak ada mutasi produk sebelum tombol konfirmasi ditekan. |
| **T24** | Deteksi konflik versi (*lock version*) | **PASS** | Model & Controller Test | Kolom `lock_version` dinaikkan pada setiap update untuk mendeteksi pengeditan bersamaan (*concurrent edits*). |
| **T25** | Penggunaan byte gambar yang sudah tervalidasi di staging | **PASS** | Importer Workflow Test | Saat konfirmasi eksekusi, sistem menggunakan file yang sudah diunduh di staging lokal tanpa mengunduh ulang URL remote. |
| **T26** | Kegagalan satu spesifikasi menggagalkan unit SKU | **PASS** | Importer Unit Test | Unit produk diperlakukan sebagai satu kesatuan atomik bersama spesifikasinya; kegagalan spesifikasi tidak menyimpan produk setengah jadi. |
| **T27** | Idempotensi eksekusi impor | **PASS** | Importer Unit Test | Menjalankan ulang unit yang sudah dieksekusi menghasilkan status `unchanged` tanpa menduplikasi data atau relasi galeri. |
| **T28** | Opsi impor hanya baris valid saat ada baris error | **PASS** | Controller / View Test | Form preview menyediakan opsi eksplisit *Skip Errors* untuk mengabaikan unit bermasalah dan mengimpor unit yang valid. |
| **T29** | Export katalog lalu re-import tanpa edit | **PASS** | Automated Pest Test | File hasil ekspor memiliki struktur yang sama dengan template dan dapat diimpor kembali menghasilkan status `unchanged`. |
| **T30** | Aksi galeri: merge, replace, dan clear | **PASS** | Importer & Media Test | Pengaturan `gallery_action` ditaati: `replace` mengganti referensi galeri, `merge` menambahkan, `clear` mengosongkan relasi. |
| **T31** | Hapus permanen media yang masih dipakai entitas lain | **PASS** | Media Service Test | `MediaService::deleteAsset` memeriksa tabel `media_usages`; media yang masih direferensikan oleh produk/artikel lain ditolak untuk dihapus. |
| **T32** | Teks diawali karakter formula (`=`, `+`, `-`, `@`) | **PASS** | Service / Exporter Test | Karakter disimpan sebagai literal string dan diekspor menggunakan cell type string eksplisit tanpa menjadi formula aktif di Excel. |
| **T33** | Paginasi server-side dan penanganan data besar | **PASS** | Automated Pest Test | Daftar produk dipaginasikan 24 item per halaman secara server-side dengan query filter terindeks tanpa mengeksekusi *unbounded all*. |
| **T34** | Kebijakan Non-Transaksional (Tanpa Harga, Stok, Cart) | **PASS** | Automated Pest Test | Model `Product`, view publik, form backoffice, dan template Excel 100% bebas dari kolom `price`, `stock`, `cart`, `checkout`, atau `order`. |
| **T35** | Pergantian slug URL dan penanganan redirect | **PASS** | Model & Redirect Table | Perubahan slug disimpan pada tabel `url_redirects` untuk menjaga kompatibilitas SEO tautan lama. |

---

## 2. Hasil Ringkasan Pengujian Otomatis

Eksekusi rangkaian pengujian fitur (`tests/Feature/CatalogAndBackofficeTest.php`):
```text
   PASS  Tests\Feature\CatalogAndBackofficeTest
  ✓ T01: All public catalog and content pages load with 200 OK
  ✓ T03: Guest access to backoffice is redirected to login
  ✓ T04: Editor cannot access Admin-only modules like settings and user management
  ✓ T05: Backoffice authentication enforces rate limit and regenerates session on login
  ✓ T08: Product can be created with technical specifications and displayed publicly
  ✓ T09: HTML Sanitizer Service strips harmful script tags, onclick, and javascript URIs
  ✓ T11: Future scheduled articles are not visible to guests
  ✓ T14: SKU normalization preserves uppercase, prefixes, and leading zeros
  ✓ T21: DriveDownloadAdapter blocks SSRF to internal IPs, loopback, and metadata servers
  ✓ T34: Strict enforcement of zero sales fields (no price, stock, cart, checkout)
  ✓ T12 & T13: Excel template and exporter generate valid multi-sheet workbooks
  ✓ T16 & T17: ProductExcelService executeUnit creates, updates, and modifies specs

  Tests:    12 passed (81 assertions)
  Duration: 2.83s
```

---

## 3. Verifikasi Responsivitas dan Aksesibilitas UI

1. **Desktop (1440 px):**
   - Header sticky dengan navigasi lengkap, tombol ganti bahasa [ EN | ID ], dan shadow lembut.
   - Grid 4 kolom untuk katalog produk, galeri gambar produk dengan rasio `contain` rapi.
   - Tabel spesifikasi teknis terbaca jelas dengan strip zebra.
2. **Tablet (768 px):**
   - Grid 2-3 kolom yang fleksibel dan proporsional.
   - Filter pencarian beralih ke tata letak bertumpuk yang ergonomis.
3. **Mobile (360 px):**
   - Menu navigasi mobile responsif (*hamburger drawer*).
   - Tabel panjang di backoffice dan spesifikasi produk memiliki scrolling horizontal di dalam containernya tanpa menyebabkan horizontal overflow pada halaman (*zero page horizontal scroll*).
   - Input touch-friendly dan kontras warna memenuhi standar WCAG AA.
