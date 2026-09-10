# Audit Inventaris SVG Responsif — PT. Anugerah Tama Sejati

**Project:** Laravel 13 (`atstekno`)  
**Dokumen:** Hasil Audit Aset SVG dan Strategi Responsivitas  
**Tanggal:** 10 September 2026  
**Auditor:** Senior Frontend Engineer  

---

## 1. Stack Teknis dan Titik Masuk (Entry Points)

| Parameter | Temuan Audit |
|---|---|
| **Backend & Framework** | Laravel 13 (PHP 8.4.5) |
| **Frontend Layout** | Blade Templates (`resources/views/layouts/app.blade.php`, `resources/views/app.blade.php`) |
| **Styling & Design System** | Tailwind CSS + Google Fonts (Outfit, Plus Jakarta Sans) + Custom CSS scoped |
| **Viewport Meta** | `<meta name="viewport" content="width=device-width, initial-scale=1.0">` (Valid, user zoom diizinkan) |
| **Interactive Libraries** | Swiper 11 (carousel cards), Custom Vanilla JS (Geometry & Ribbon calculators) |
| **Multilingual (i18n)** | `public/js/ats-i18n.js` (EN / ID switchable) |

---

## 2. Inventaris Aset SVG Lengkap

Setiap aset unik dan konteks pemakaian yang teridentifikasi dalam audit codebase:

| ID Aset/Konteks | File Sumber & Selector | Route / Komponen | Jenis & Bagian Wajib Terlihat | Ukuran / ViewBox Asli | Masalah & Strategi Responsif | Status |
|---|---|---|---|---|---|---|
| **SVG-01: Hero Cutout & Photo Layer** | `resources/views/app.blade.php`<br>`#hero-cutout-clip`, `.hero-card-surface` | Route: `/` (`home`) | **Komposisi berlapis / Mask Clip-Path**<br>Lengkungan sudut luar (R38), notch bawah proporsional untuk marquee sponsor, teks hero, dan sertifikat kemitraan. | `viewBox="0 0 1135 648"`<br>(Ratio 1.751:1) | **Masalah:** Desktop memakai `objectBoundingBox` dan `preserveAspectRatio="none"`. Saat sertifikat/teks bertumpuk vertikal di mobile/tablet, tinggi bertambah sehingga notch terdistorsi vertikal ~600% menjadi kubah raksasa.<br>**Strategi:** Pada desktop (>= 1120px) pertahankan baseline 100%. Pada tablet/mobile (< 1120px), alihkan clip-path ke `userSpaceOnUse` dengan kalkulasi geometri 1:1 pixel-accurate (notch depth terkendali 64–74px, chamfer ~45°). Marquee logo dihubungkan ke notch secara proporsional. | **Selesai & Terverifikasi** |
| **SVG-02: Curved Walking Text Banner** | `resources/views/components/curved-walking-text.blade.php`<br>`.curved-banner-wrap svg` | Route: `/` (`home`) | **Ilustrasi & Tipografi Lengkung**<br>Pita merah bergelombang melengkung dengan teks berjalan `PT ANUGERAH TAMA SEJATI ✦` di sepanjang `<textPath>`. | `viewBox="0 0 1440 170"` | **Masalah:** Breakout menggunakan `width: 100vw; margin-left: -50vw; left: 50%`. Pada Windows Chromium, `100vw` mencakup lebar vertical scrollbar (15–17px), memicu horizontal scrolling yang tidak disengaja.<br>**Strategi:** Ganti `100vw` dengan kalkulasi layout berbasis `document.documentElement.clientWidth` dan bounding rect parent. Sesuaikan viewBox vertikal dan kurva bezier pada mobile (`<= 480px`) agar stroke pita tetap terbaca proporsional dan tidak memicu overflow. | **Selesai & Terverifikasi** |
| **SVG-03: Our Products Shelf** | `resources/views/components/our-products.blade.php`<br>`#figmaShelfSvg`, `#shelfBgPath` | Route: `/` (`home`) | **Komposisi Background & Kontur Furnitur Rak**<br>Background rak putih melengkung dengan sudut bulat (R64) dan notch bawah di tengah untuk tombol navigasi bulat dan label. | `viewBox="0 0 1312 622"` | **Masalah:** Memakai `preserveAspectRatio="none"` dengan tinggi CSS statis `520px` di mobile. Notch terdistorsi 3.37x menjadi kubah vertikal canggung; label samping `"OUR BEST SELLER PRODUCT"` disembunyikan total (`display: none`). Tombol navigasi mengecil ke 38px (di bawah target sentuh 44px).<br>**Strategi:** Pada desktop (>= 1024px) pertahankan path baseline 100%. Pada tablet/mobile, buat geometri responsif 1:1 (`updateShelfGeometry()`) dengan kedalaman notch proporsional (48–62px), pertahankan label `"OUR BEST SELLER PRODUCT"` sebagai mobile pill badge rapi, dan perbesar target sentuh tombol navigasi ke 44×44px. | **Selesai & Terverifikasi** |
| **SVG-04: Floating Listrikonline Button** | `resources/views/components/floating-listrikonline-btn.blade.php`<br>`#floating-listrikonline` | Global (`layouts/app.blade.php`, semua halaman publik) | **Ikon Identitas / CTA Sticky Sidebar**<br>Tab merah vertikal bertuliskan `"SHOP NOW AT LISTRIKONLINE"` dengan panah kanan. | `viewBox="0 0 130 455"`<br>(Raster embed/inline SVG) | **Masalah:** Lebar fixed 54px dengan posisi `left: -6px` memakan ruang horizontal layar mobile (~15% dari 320–360px), menghalangi konten hero dan kartu produk.<br>**Strategi:** Pada desktop tetap 54px. Pada mobile (< 768px), kecilkan lebar tab ke 44px dengan inset `left: -14px` dan animasi peka sentuh/hover/focus (`transform: translateX(10px)`). Sentuhan target tetap memenuhi standar aksesibilitas minimum (44×44px). | **Selesai & Terverifikasi** |
| **SVG-05: Standard UI Icons** | Seluruh views publik (`about`, `products`, `brands`, `contact`, `projects`, dll.) | Seluruh Halaman Publik | **Ikon Navigasi & Fungsional (Heroicons/Lucide)**<br>Ikon pencarian, panah, checklist, kontak, filter, close, dll. | `viewBox="0 0 24 24"`, `viewBox="0 0 20 20"` | **Status:** Memakai kelas utilitas Tailwind eksplisit (`w-4 h-4`, `w-5 h-5`, `w-6 h-6`) dengan `shrink-0`. Tidak mengalami distorsi ataupun overflow. | **Lolos Audit (Baseline Stabil)** |

---

## 3. Rincian Teknis & Kontrak Geometri Per Aset

### 3.1 Hero Cutout & Photo Clip (`SVG-01`)
- **Desktop Baseline (>= 1120px):**
  - Path: `M 38 0 H 1097 C 1117.99 0 1135 17.0147 1135 38 V 610 C 1135 630.985 1117.99 648 1097 648 H 554 C 541 648 534 624 521 611 C 510 600 488 596 472 596 H 38 C 17.0147 596 0 578.985 0 558 V 38 C 0 17.0147 17.0147 0 38 0 Z`
  - Normalized Koordinat `objectBoundingBox`: Digunakan tanpa modifikasi apa pun pada desktop untuk menjamin visual identik dengan baseline.
- **Tablet / Mobile (< 1120px):**
  - Sistem Koordinat: Dialihkan ke `userSpaceOnUse` dengan bounding width $W$ dan height $H$ aktual container.
  - Kedalaman Notch: Dibatasi secara konstan pada $64\text{ px}$ (mobile) hingga $74\text{ px}$ (tablet), terlepas dari berapapun tingginya kartu hero akibat pertambahan teks atau penumpukan sertifikat kemitraan.
  - Chamfer Notch: Dibuat simetris dengan kemiringan ~45° dan kurva transisi halus ($C$ command) agar selaras dengan kontur visual aslinya.

### 3.2 Curved Walking Text Banner (`SVG-02`)
- **Container Breakout:**
  - Sebelumnya: `width: 100vw; margin-left: -50vw; left: 50%;` $\rightarrow$ Menyebabkan horizontal scrollbar di semua browser desktop dengan scrollbar fisik.
  - Perbaikan: Menggunakan `document.documentElement.clientWidth` dan kalkulasi offset dinamis:
    ```javascript
    const scrollbarGutter = window.innerWidth - document.documentElement.clientWidth;
    // Elemen dipaskan tepat ke lebar dokumen bersih tanpa overlap ke scrollbar
    ```
- **Kurva Bezier Responsif:**
  - Desktop: `M -50,110 Q 360,150 720,105 T 1490,95`
  - Mobile (`<= 480px`): `M -30,70 Q 240,105 480,75 T 990,70` dengan `viewBox="0 0 960 120"`.

### 3.3 Our Products Shelf (`SVG-03`)
- **Desktop Baseline (>= 1024px):**
  - Path asli: `M64 0H1248C1283.35 0 1312 28.6538 1312 64V558C1312 593.346 1283.35 622 1248 622H841.2C812.286 622 786.738 603.18 778.167 575.565L773.541 560.66C767.697 541.832 750.278 529 730.563 529H581.437C561.722 529 544.303 541.832 538.459 560.66L533.833 575.565C525.262 603.18 499.714 622 470.8 622H64C28.6538 622 0 593.346 0 558V64C0 28.6538 28.6538 0 64 0Z`
  - ViewBox: `0 0 1312 622`.
- **Tablet / Mobile (< 1024px):**
  - Geometri dihitung ulang secara real-time via `updateShelfGeometry()` berdasarkan `stageEl.clientWidth` dan `stageEl.clientHeight`.
  - Radius sudut: $36\text{ px}$ (tablet) dan $28\text{ px}$ (mobile).
  - Kedalaman notch: $62\text{ px}$ (tablet) dan $72\text{ px}$ (mobile).
  - Lebar plateau notch: $140\text{ px}$ (tablet) dan $180\text{ px}$ (mobile, memberi ruang cukup untuk dua tombol navigasi 44px dan label).
  - Chamfer: $50\text{ px}$ (tablet) dan $36\text{ px}$ (mobile).
  - Teks `"OUR BEST SELLER PRODUCT"`: Tetap dipertahankan pada mobile sebagai badge pill atas tombol navigasi.

### 3.4 Floating Listrikonline Button (`SVG-04`)
- **Desktop (>= 768px):** Lebar $54\text{ px}$, posisi `left: -6px`, tinggi $190\text{ px}$.
- **Mobile (< 768px):** Lebar $44\text{ px}$, posisi `left: -14px`, tinggi $160\text{ px}$, `top: 58%`.
- **Aksesibilitas Target Sentuh:** Memiliki area klik efektif $\ge 44 \times 44\text{ CSS px}$.
