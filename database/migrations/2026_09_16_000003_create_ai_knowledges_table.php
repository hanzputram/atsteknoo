<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ai_knowledges', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('general'); // product, pricing, faq, policy, instruction, general
            $table->string('trigger_keywords')->nullable();
            $table->text('content');
            $table->boolean('is_active')->default(true);
            $table->integer('priority')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // Seed initial core company knowledge so admin can manage them immediately from backoffice
        $now = now();
        DB::table('ai_knowledges')->insert([
            [
                'title' => 'Authorized Dealer Schneider Electric',
                'category' => 'product',
                'trigger_keywords' => 'schneider, mcb, mccb, acb, kontaktor, tesys, inverter, altivar',
                'content' => "PT. Anugerah Tama Sejati adalah Authorized Dealer resmi Schneider Electric Indonesia. Menyediakan MCB (Acti9, Domae, iK60N), MCCB (Compact NSX, EasyPact CVS/EZC), ACB (MasterPact MTZ/NT/NW), Kontaktor (TeSys D, TeSys K, TeSys F), Inverter & Drive (Altivar ATV310, ATV630, ATV930), Thermal Overload Relay, Push Button Harmony, Power Meter (PM5000 series). Semua barang 100% original bergaransi resmi pabrik dengan sertifikat origin.",
                'is_active' => true,
                'priority' => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Distributor Resmi GAE, Legrand, Socomec & Autonics',
                'category' => 'product',
                'trigger_keywords' => 'gae, legrand, socomec, autonics, cos, timer, sensor',
                'content' => "Selain Schneider, ATS juga merupakan Authorized Dealer resmi untuk: 1) GAE Group: Kabel, busbar support, insulator, aksesoris panel, metering switchgear. 2) Legrand: Modular circuit breaker, distribution switchboards, industri enclosure, industrial plugs & sockets. 3) Socomec: Changeover Switch (COS), ATS Motorized. 4) Autonics: Sensor & timer digital controller.",
                'is_active' => true,
                'priority' => 20,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Divisi Panel Maker Bersertifikasi IEC 61439 & SNI',
                'category' => 'product',
                'trigger_keywords' => 'panel, lvmdp, sdp, mcc, genset, kapasitor, amf, cubicle',
                'content' => "ATS memiliki workshop panel maker berstandar IEC 61439-1/2 dan SNI. Melayani perakitan: Low Voltage Main Distribution Panel (LVMDP), Sub Distribution Panel (SDP), Motor Control Center (MCC - Star Delta, Soft Starter, Inverter/VFD), Automatic Capacitor Bank, Synchronizing Genset Panel, dan ATS-AMF Otomatis. Semua panel dilengkapi Factory Acceptance Test (FAT) dan gambar Single Line Diagram (SLD).",
                'is_active' => true,
                'priority' => 30,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Kebijakan Penawaran Harga & BoQ Proyek (SOP Admin)',
                'category' => 'pricing',
                'trigger_keywords' => 'harga, diskon, murah, penawaran, boq, rab, brosur, pricelist',
                'content' => "AI tidak boleh mengarang angka harga nominal atau menjanjikan diskon fiktif tanpa konfirmasi, karena harga material listrik bergantung pada volume BoQ dan kurs tembaga/pabrik. Selalu arahkan pengunjung dengan sopan untuk mengirimkan file BoQ atau daftar kebutuhan ke WhatsApp Hotline (+62 822 2333 2830) atau email sales@atstekno.com. Berikan penegasan bahwa tim sales ATS siap memberikan diskon distributor terbaik untuk kebutuhan proyek.",
                'is_active' => true,
                'priority' => 40,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Lokasi Kantor Pusat, Showroom & Gudang Resmi',
                'category' => 'general',
                'trigger_keywords' => 'alamat, lokasi, kantor, gudang, showroom, surabaya, pasuruan',
                'content' => "Lokasi PT. Anugerah Tama Sejati: 1) Kantor Pusat & Gudang Utama: Ruko Galaxi Bumi Permai J-1 No. 23, Surabaya. 2) Cabang Showroom Jagalan: Jl. Jagalan No. 38, Surabaya. 3) Cabang Showroom Pandaan: The Taman Dayu, Cluster Palazio Boulevard J-1 No. 06, Pandaan, Pasuruan. Jam operasional: Senin–Jumat 08:00–17:00 WIB, Sabtu 08:00–16:00 WIB.",
                'is_active' => true,
                'priority' => 50,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Pedoman Komunikasi & Sikap ATS Support',
                'category' => 'instruction',
                'trigger_keywords' => 'gaya bicara, etika, respon, salam, identitas',
                'content' => "Nama identitas resmi adalah 'ATS Support'. Selalu berbicara dengan nada ramah, sopan, profesional, dan solutif layaknya engineer customer care resmi. Dilarang keras menyebut diri sebagai robot atau kecerdasan buatan. Sapa nama pengunjung secara personal jika nama mereka sudah diketahui.",
                'is_active' => true,
                'priority' => 60,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_knowledges');
    }
};
