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
        $now = now();

        DB::table('ai_knowledges')->updateOrInsert(
            ['title' => 'Pembelian Cepat via ListrikOnline & SOP Produk Belum Terdaftar'],
            [
                'category' => 'product',
                'trigger_keywords' => 'beli, beli cepat, order, checkout, listrikonline, cari barang, ada jual, ketersediaan, stok, produk tidak ada, cek barang',
                'content' => "1. PEMBELIAN CEPAT / LANGSUNG ONLINE (PRODUK TERSEDIA DI ATSTEKNO.COM):
Jika pengunjung ingin membeli produk dengan cepat / langsung tanpa menunggu penawaran formal BoQ, dan produk tersebut ADA / TERSEDIA di katalog website atstekno.com:
- Arahkan pengunjung secara langsung untuk membeli di platform e-commerce resmi kami yaitu ListrikOnline:
  Format link: https://listrikonline.com/products/{sku} (atau https://listrikonline.com/{produk-yang-diinginkan}).
- Berikan penjelasan ramah: 'Untuk pembelian langsung dengan cepat dan praktis, Kakak bisa langsung checkout melalui platform online resmi kami di ListrikOnline: https://listrikonline.com/products/{sku}. Transaksi di ListrikOnline cepat, aman, stok terupdate, dan seluruh barang 100% original bergaransi resmi pabrik.'

2. JIKA PRODUK TIDAK ADA DI WEBSITE ATSTEKNO.COM:
Jika produk yang dicari/ditanyakan pengunjung TIDAK ADA di katalog atstekno.com atau belum terdaftar:
- JANGAN mengarang bahwa barang ready stock.
- Jawab bahwa ketersediaan produk tersebut SEDANG KAMI CEK terlebih dahulu dengan tim gudang/logistik kami.
- Contoh balasan: 'Mohon ditunggu sebentar ya Kak, untuk ketersediaan produk [sebutkan nama produk] tersebut sedang kami cek terlebih dahulu dengan tim gudang/logistik kami. Kami akan segera mengabari Kakak kembali di sini atau via WhatsApp jika Kakak berkenan meninggalkan nomor kontak.'
- PENTING: Anda WAJIB menyertakan kode/token [NEEDS_ADMIN] di bagian paling akhir jawaban Anda. Token ini akan otomatis dideteksi sistem untuk memicu notifikasi alarm prioritas ke admin backoffice agar admin segera mengecek stok fisik atau menawarkan tipe alternatif yang sesuai!",
                'is_active' => true,
                'priority' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('ai_knowledges')
            ->where('title', 'Pembelian Cepat via ListrikOnline & SOP Produk Belum Terdaftar')
            ->delete();
    }
};
