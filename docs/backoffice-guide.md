# Panduan Operasional Backoffice Katalog — PT. Anugerah Tama Sejati

Dokumen panduan resmi pengelolaan konten katalog elektrikal, portofolio proyek, editorial artikel, dan konfigurasi website PT. Anugerah Tama Sejati.

---

## 1. Akses dan Keamanan Sistem

### 1.1 URL Masuk (Login)
- **URL Backoffice:** `http://localhost:8000/backoffice/login` (atau `/backoffice` yang otomatis mengarahkan ke halaman login).
- **Format Kredensial:** Username staf (misal: `superats888`) atau email, dan kata sandi (minimal 12 karakter).
- **Proteksi Akses:** 
  - Percobaan login dibatasi maksimal 5 kali per menit per kombinasi username/IP.
  - Session login otomatis diregenerasi setelah login berhasil untuk mencegah *session fixation*.
  - Logout wajib menggunakan metode HTTP POST dan otomatis membatalkan token sesi.

### 1.2 Pembuatan Akun Administrator Pertama (Bootstrap)
Gunakan perintah Artisan CLI untuk membuat akun Admin awal:
```bash
php artisan app:create-admin
```
Perintah ini interaktif dan meminta Username (default: `superats888`), Email, Nama, dan Password aman tanpa menyimpan password default di repositori publik. Jika akun dengan email atau username tersebut sudah ada, sistem tidak akan menimpa password yang sudah ada tanpa konfirmasi.

---

## 2. Struktur Hak Akses (Role-Based Access Control)

Sistem membedakan dua tingkat wewenang server-side:

| Fitur / Modul | Administrator (Admin) | Editor Konten |
| :--- | :---: | :---: |
| **Masuk Backoffice & Dashboard Statistik** | Ya | Ya |
| **Kelola Produk (CRUD, Spesifikasi, Galeri, SEO)** | Ya | Ya |
| **Import Massal (.xlsx) & Export Katalog** | Ya | Ya |
| **Kelola Portofolio Proyek & Kategori Proyek** | Ya | Ya |
| **Kelola Artikel, Kategori Artikel, dan Tag** | Ya | Ya |
| **Kelola Brand & Kategori Produk** | Ya | Ya |
| **Kotak Masuk Pesan Pelanggan (Inquiries)** | Ya (Bisa Hapus) | Ya (Ubah Status) |
| **Kelola Halaman Statis (About Us)** | Ya | Tidak (View Only) |
| **Pengaturan Website & Kontak Resmi** | Ya | Tidak |
| **Manajemen Staf Pengguna (Tambah/Edit/Hapus)** | Ya | Tidak |
| **Proteksi Admin Terakhir** | Dilindungi Sistem | - |

---

## 3. Modul Pengelolaan Konten

### 3.1 Master Produk (Katalog Elektrikal)
- **Navigasi:** Backoffice &rarr; `Produk` (`/backoffice/products`)
- **Fitur Utama:**
  - **Identitas SKU:** SKU disimpan sebagai teks persis (mempertahankan prefix seperti `SE-`, `FORT-`, tanda hubung, dan nol di depan seperti `000123`). Normalisasi sistem menggunakan huruf kapital untuk pencocokan unik.
  - **Nama & Deskripsi WYSIWYG:** Deskripsi menggunakan editor visual dan disanitasi otomatis di server untuk mencegah injeksi script berbahaya.
  - **Spesifikasi Teknis Fleksibel:** Menggunakan repeater dinamis (Parameter / Label, Nilai Teknis, Satuan, dan Kelompok). Baris kosong otomatis diabaikan.
  - **Media Gambar:** Satu gambar utama (`object-fit: contain` di halaman publik) dan multi-gambar galeri.
  - **Datasheet PDF:** File dokumen teknis PDF dapat diunggah dan diunduh pengunjung di halaman detail produk.
  - **Status Publikasi:** `draft` (tersimpan privat), `published` (tampil publik), `archived` (arsip nonaktif). Produk hanya dapat dipublikasikan jika memiliki deskripsi, brand, dan minimal satu kategori aktif.
  - **Kebijakan Katalog Murni:** Form produk secara tegas tidak memuat harga, stok, diskon, atau tombol pembelian e-commerce.

### 3.2 Master Brand & Kategori Produk
- **Brand:** Kode brand unik, nama prinsipal, unggah logo, website resmi prinsipal, dan deskripsi profil.
- **Kategori Produk:** Kode unik, hierarki induk-anak (parent-child), slug URL, dan status aktif.

### 3.3 Portofolio Proyek Rekayasa (Projects)
- **Navigasi:** Backoffice &rarr; `Proyek` (`/backoffice/projects`)
- **Isi Proyek:**
  - Kode proyek unik dan judul portofolio.
  - Kategori pekerjaan (misal: Substation, Commercial High-Rise, Food & Beverage MCC).
  - Ringkasan ruang lingkup pekerjaan (*Scope of Work*).
  - Gambar sampul utama dan galeri dokumentasi foto lapangan.
  - Lokasi kota dan tahun penyelesaian proyek.

### 3.4 Artikel & Wawasan Industri (Editorial)
- **Navigasi:** Backoffice &rarr; `Artikel` (`/backoffice/articles`)
- **Isi Artikel:**
  - Judul artikel (otomatis menjadi satu-satunya H1 pada halaman publik).
  - Thumbnail gambar dan alt text yang dapat disunting.
  - Konten WYSIWYG lengkap (mendukung heading H2–H4, paragraf, penomoran, kutipan, dan tabel).
  - Kategori artikel dan label topik (Tags).
  - **Penjadwalan Publikasi:** Mengatur `published_at` di masa depan membuat artikel berstatus *Terjadwal* dan baru otomatis muncul ke publik saat waktu server telah tercapai.
  - Nama penulis publik (*author display name*) yang dapat ditentukan tanpa membocorkan email staf.

### 3.5 Halaman Perusahaan (About Us)
- **Navigasi:** Backoffice &rarr; `Halaman` (`/backoffice/pages`)
- Mengelola narasi profil perusahaan, visi, misi, dan sejarah singkat PT. Anugerah Tama Sejati.

### 3.6 Pengaturan Website (Settings)
- **Navigasi:** Backoffice &rarr; `Pengaturan` (`/backoffice/settings`)
- Mengubah nama perusahaan, slogan/tagline, alamat kantor pusat & gudang, nomor telepon, WhatsApp konsultasi resmi, email, link Google Maps, akun sosial media (LinkedIn, Instagram), serta default SEO meta title/description. Perubahan langsung tercermin pada header dan footer seluruh halaman website.

### 3.7 Kotak Masuk Pesan (Inquiries)
- **Navigasi:** Backoffice &rarr; `Pesan Masuk` (`/backoffice/inquiries`)
- Menampung pesan dari formulir kontak publik lengkap dengan nama pengirim, email, nomor WhatsApp/telepon, subjek, isi kebutuhan BoQ, dan alamat IP.
- Filter status pesan: `Belum Dibaca`, `Sudah Dibaca`, `Selesai Ditangani`, dan `Spam`.
- Tombol cepat untuk membalas via Email atau membuka chat WhatsApp resmi dengan pengirim.

---

## 4. Keamanan Media dan Sanitasi Konten

1. **Pengiriman Media Privat:** File media yang diunggah dikelola oleh delivery controller (`/media/{id}/view`). Pengguna tamu publik hanya dapat melihat aset media yang terkait dengan konten berstatus `published`.
2. **Sanitasi HTML Server-Side:** Seluruh input dari form maupun berkas Excel dibersihkan melalui `HtmlSanitizerService` berbasis DOM XML parser. Script, event handler JavaScript (`onclick`, `onload`), iframe liar, dan URI berbahaya (`javascript:`) otomatis dieliminasi.
3. **Pemberian Nama Acak:** Berkas yang disimpan di server menggunakan nama berbasis hash acak untuk mencegah penimpaan file atau eksekusi berbahaya.
