# Panduan Impor dan Pembaruan Massal Produk Excel (.xlsx)

Panduan operasional teknis untuk mengimpor dan memperbarui ribuan produk elektrikal secara massal menggunakan file spreadsheet Excel (.xlsx), dilengkapi pengunduh otomatis gambar dari Google Drive.

---

## 1. Ringkasan Alur Kerja Impor

Proses impor terbagi menjadi 5 tahap aman:
1. **Unduh Template:** Ambil template resmi melalui tombol `Unduh Template Produk (.xlsx)` di menu Import Center (`/backoffice/import-products`).
2. **Pengisian Data:** Lengkapi sheet `products` dan sheet opsional `product_specifications`.
3. **Unggah & Validasi:** Pilih mode pencocokan (`Upsert`, `Create only`, atau `Update only`), lalu unggah berkas. Sistem memvalidasi struktur, header, normalisasi SKU, relasi, dan mengunduh gambar ke area penampungan sementara (*staging*).
4. **Preview:** Tinjau rincian perubahan: jumlah produk baru, produk diperbarui, unit dengan error, thumbnail gambar hasil unduh Google Drive, dan perbandingan sebelum/sesudah.
5. **Eksekusi:** Klik `Konfirmasi & Terapkan Perubahan`. Transaksi dieksekusi secara atomik per unit SKU sehingga kegagalan satu baris tidak menggagalkan seluruh file.

---

## 2. Struktur Sheet dan Kontrak Kolom

Workbook template terdiri dari 5 lembar kerja (sheet):

| Nama Sheet | Fungsi | Wajib / Opsional |
| :--- | :--- | :--- |
| `products` | Data utama produk (SKU, nama, deskripsi, brand, kategori, link gambar Drive). | **Wajib** |
| `product_specifications` | Daftar parameter teknis produk (tegangan, arus nominal, pole, ukuran). | Opsional |
| `_instructions` | Panduan ringkas pengisian kolom. | Referensi |
| `_brands` | Daftar kode dan nama brand aktif yang tersedia di database. | Lookup |
| `_categories` | Daftar kode dan nama kategori produk aktif di database. | Lookup |

### 2.1 Format Kolom Sheet `products`

| Header Kolom | Tipe Data | Keterangan & Aturan |
| :--- | :--- | :--- |
| `sku` | Teks (Wajib) | Kunci unik pencocokan. Simpan sebagai format Text di Excel agar nol di depan (`000123`) atau tanda hubung (`FORT-AB-001`) tidak hilang. |
| `name` | Teks | Nama produk. Wajib untuk produk baru; boleh kosong saat memperbarui. |
| `short_description` | Teks | Ringkasan singkat untuk tampilan kartu produk. |
| `description_html` | Teks / HTML | Uraian lengkap produk. Plain text akan otomatis diubah ke paragraf aman; script berbahaya disanitasi. |
| `brand_code` | Teks | Kode brand sesuai sheet `_brands` (contoh: `SE`, `ABB`, `SOCOMEC`). |
| `category_codes` | Teks | Satu atau beberapa kode kategori dipisahkan tanda titik koma (contoh: `ACB;LVMDP`). |
| `primary_category_code` | Teks | Kategori utama produk, harus salah satu dari `category_codes`. |
| `slug` | Teks | Slug URL. Jika kosong, dibuat otomatis dari nama produk dan SKU. |
| `meta_title` | Teks | Judul metadata untuk mesin pencari Google. |
| `meta_description` | Teks | Deskripsi ringkas untuk snippet Google. |
| `status` | Pilihan | `draft`, `published`, atau `archived`. |
| `is_featured` | Angka / Boolean | `1` (unggul) atau `0` (biasa). |
| `sort_order` | Angka | Urutan tampil (integer positif, default 0). |
| `link_gdrive` | URL | URL tautan publik Google Drive untuk gambar utama produk. |
| `main_image_media_id` | Angka | Alternatif jika menggunakan ID media lokal yang sudah ada di server. |
| `image_alt` | Teks | Teks alt gambar untuk aksesibilitas dan SEO gambar. |
| `gallery_links` | Teks (URL) | Link gambar galeri Google Drive, dipisahkan tanda titik koma (`;`). |
| `gallery_media_ids` | Teks (ID) | Alternatif daftar ID media lokal, dipisahkan titik koma (`;`). |
| `gallery_action` | Pilihan | `preserve` (pertahankan), `merge` (gabungkan), `replace` (ganti semua), `clear` (hapus galeri). |

### 2.2 Format Kolom Sheet `product_specifications`

| Header Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `sku` | Teks (Wajib) | Harus cocok dengan baris SKU yang ada pada sheet `products`. |
| `attribute_code` | Teks (Wajib) | Kode stabil unik per SKU (contoh: `rated_current`, `breaking_capacity`). |
| `label` | Teks (Wajib) | Nama parameter yang dibaca manusia (contoh: *Arus Nominal*). |
| `value` | Teks (Wajib) | Nilai parameter (contoh: `1600`, `380 - 415`). |
| `unit` | Teks | Satuan parameter (contoh: `A`, `V`, `kA`, `mm`, `kg`). |
| `group` | Teks | Pengelompokan spesifikasi (contoh: *Elektrikal*, *Mekanikal*). |
| `sort_order` | Angka | Urutan tampil spesifikasi pada tabel detail produk. |
| `operation` | Pilihan | `upsert` (tambah/perbarui) atau `remove` (hapus spesifikasi ini). |

---

## 3. Ketentuan Pengambilan Gambar Google Drive

### 3.1 Format Link yang Didukung
Sistem mengenali format share link publik resmi Google Drive:
- `https://drive.google.com/file/d/{FILE_ID}/view`
- `https://drive.google.com/file/d/{FILE_ID}/view?usp=sharing`
- `https://drive.google.com/open?id={FILE_ID}`
- `https://drive.google.com/uc?export=download&id={FILE_ID}`

### 3.2 Syarat Akses Berkas di Google Drive
1. Pastikan perizinan berkas diatur: **"Anyone with the link can view"** (Siapa saja yang memiliki link dapat melihat).
2. Tautan harus berupa **file gambar tunggal** (JPEG, PNG, WEBP), bukan tautan folder Google Drive atau dokumen Google Docs/Sheets.
3. Ukuran file maksimal adalah 10 MiB per gambar.

### 3.3 Pipeline Unduhan & Keamanan Jaringan (SSRF Protection)
- Adapter unduhan (`DriveDownloadAdapter`) memvalidasi domain tujuan hanya pada host Google Drive tepercaya (`drive.google.com`, `docs.google.com`).
- Resolusi DNS diperiksa secara ketat: alamat IP loopback (`127.0.0.1`), subnet privat (`10.x`, `192.168.x`), serta alamat metadata cloud (`169.254.169.254`) otomatis diblokir sebelum koneksi dibuat.
- Gambar diunduh ke area staging privat, diperiksa MIME dan dimensinya, lalu dibuatkan thumbnail lokal. Pengunjung website mengambil gambar dari media lokal tanpa bergantung kembali ke Google Drive.

---

## 4. Aturan Sel Kosong vs Token `__CLEAR__`

| Kondisi Nilai Sel | Saat Pembuatan (Create) | Saat Pembaruan (Update) |
| :--- | :--- | :--- |
| **Sel Kosong / Tidak Diisi** | Menggunakan nilai default / null | **Mempertahankan nilai data lama di database** |
| **Nilai `0` atau `false`** | Diterapkan sebagai nilai 0 / false | Diterapkan sebagai nilai 0 / false |
| **Token persis `__CLEAR__`** | Error (field wajib) atau null | **Menghapus nilai field opsional tersebut** |

> **Catatan Penting:** Token `__CLEAR__` tidak dapat digunakan untuk menghapus field wajib seperti SKU atau Nama Produk.

---

## 5. Mode Pencocokan SKU

1. **Upsert (Rekomendasi):**
   - Jika SKU belum ada: sistem membuat produk baru (*create*).
   - Jika SKU sudah ada: sistem memperbarui field yang dikirim (*update*).
2. **Create Only:**
   - Hanya menerima SKU yang belum terdaftar. Jika SKU sudah ada, sistem menandai baris sebagai error `SKU_ALREADY_EXISTS`.
3. **Update Only:**
   - Hanya memperbarui SKU yang sudah terdaftar. Jika SKU tidak ditemukan, sistem menghasilkan error `SKU_NOT_FOUND`.

---

## 6. Daftar Kode Kesalahan & Solusi Perbaikan

Jika berkas impor memiliki baris yang tidak valid, sistem menyediakan berkas **Laporan Error Excel (.xlsx)** yang mencantumkan:

| Kode Kesalahan | Makna | Tindakan Perbaikan |
| :--- | :--- | :--- |
| `INVALID_DRIVE_URL` | Format link Google Drive salah atau bukan file gambar. | Periksa format URL; gunakan link share berkas gambar. |
| `DRIVE_ACCESS_DENIED` | Berkas di Google Drive bersifat privat / butuh izin. | Ubah pengaturan share Google Drive menjadi "Anyone with the link". |
| `DRIVE_FILE_NOT_FOUND` | Berkas tidak ditemukan atau ID Google Drive salah. | Periksa kembali apakah file ada di Google Drive. |
| `IMAGE_DOWNLOAD_TIMEOUT`| Waktu unduh melebihi batas (timeout). | Periksa koneksi atau kurangi ukuran resolusi gambar. |
| `IMAGE_TOO_LARGE` | Ukuran gambar melebihi batas maksimal 10 MiB. | Kompres gambar atau sesuaikan dimensi sebelum diunggah. |
| `BLOCKED_REMOTE_TARGET` | URL mengarah ke jaringan privat/lokal (SSRF diblokir). | Gunakan hanya domain publik Google Drive yang sah. |
| `BRAND_NOT_FOUND` | Kode brand tidak ditemukan di sheet `_brands`. | Periksa ejaan kode brand atau buat brand baru di backoffice terlebih dahulu. |
| `CATEGORY_NOT_FOUND` | Kode kategori tidak ditemukan di sheet `_categories`. | Buat kategori di backoffice atau sesuaikan kode. |
| `SKU_ALREADY_EXISTS` | SKU sudah ada saat menjalankan mode *Create Only*. | Gunakan mode *Upsert* atau gunakan SKU lain. |
| `SKU_NOT_FOUND` | SKU tidak ditemukan saat mode *Update Only*. | Periksa ejaan SKU atau gunakan mode *Upsert*. |
| `DUPLICATE_SKU_IN_FILE` | Dua baris memiliki SKU sama dalam satu berkas. | Hapus baris duplikat; satu SKU hanya boleh muncul satu kali pada sheet products. |

---

## 7. Kebijakan Katalog Murni (Non-Transaksional)

Kolom komersial penjualan seperti `price` (harga), `stock` (stok), `discount` (diskon), dan `hpp` secara tegas **tidak diproses** oleh sistem impor. Katalog ini murni untuk spesifikasi teknik industri, portofolio rekayasa, dan permintaan penawaran harga (BoQ).
