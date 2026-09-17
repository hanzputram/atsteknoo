<?php

namespace App\Support;

class SeoFaqRegistry
{
    /**
     * Retrieve curated FAQ entries for a product by its slug.
     *
     * @param string $slug
     * @return array<int, array{q_id: string, q_en: string, a_id: string, a_en: string}>|null
     */
    public static function getProductFaq(string $slug): ?array
    {
        $faqs = self::productFaqs();
        return $faqs[$slug] ?? null;
    }

    /**
     * Retrieve curated FAQ entries for an article by its slug.
     *
     * @param string $slug
     * @return array<int, array{q_id: string, q_en: string, a_id: string, a_en: string}>|null
     */
    public static function getArticleFaq(string $slug): ?array
    {
        $faqs = self::articleFaqs();
        return $faqs[$slug] ?? null;
    }

    /**
     * Product FAQ Definitions (AEO Optimized with 40-60 words self-contained opening answers).
     */
    public static function productFaqs(): array
    {
        return [
            'schneider-electric-mcb-domae-1p-6a-6ka-domf01106' => [
                [
                    'q_id' => 'Apa itu MCB Domae 1P 6A dan untuk apa fungsinya?',
                    'q_en' => 'What is the Schneider Domae MCB 1P 6A used for?',
                    'a_id' => 'MCB Domae 1P 6A <6KA (DOMF01106) adalah miniature circuit breaker 1 fasa dari Schneider Electric yang berfungsi melindungi instalasi listrik dari beban lebih dan hubung singkat, dengan kapasitas pemutusan hingga 6kA pada 230V AC.',
                    'a_en' => 'The Schneider Domae MCB 1P 6A <6kA (DOMF01106) is a single-pole miniature circuit breaker rated 6A with up to 6kA breaking capacity at 230V AC, used to protect low-voltage circuits from overload and short-circuit current in residential and light industrial panels.'
                ],
                [
                    'q_id' => 'Berapa breaking capacity dan curve code MCB DOMF01106?',
                    'q_en' => 'What are the breaking capacity and curve code of MCB DOMF01106?',
                    'a_id' => 'Breaking capacity-nya <6kA dengan curve code C, sesuai standar IEC 60898-1, cocok untuk beban umum seperti lighting dan stop kontak.',
                    'a_en' => 'It features a breaking capacity of <6kA with C-curve trip characteristics conforming to IEC 60898-1 standards, ideal for standard resistive and inductive loads such as lighting circuits and socket outlets.'
                ],
                [
                    'q_id' => 'Apakah MCB ini bisa dipasang di rel DIN standar?',
                    'q_en' => 'Can this MCB be mounted on a standard DIN rail?',
                    'a_id' => 'Ya, MCB Domae dirancang untuk dipasang pada DIN rail modular dengan lebar 2 pitch (18mm), sesuai panel listrik standar industri maupun rumah tangga.',
                    'a_en' => 'Yes, the Domae MCB is designed for toolless snap-on mounting on standard 35mm modular DIN rails with a single-pole width of 18mm (1 module).'
                ],
                [
                    'q_id' => 'Apakah stok MCB DOMF01106 tersedia ready di Surabaya?',
                    'q_en' => 'Is MCB DOMF01106 in stock and ready to ship in Surabaya?',
                    'a_id' => 'Ya, ATS Tekno menyediakan stok ready di gudang Surabaya untuk pengiriman cepat ke seluruh Indonesia, termasuk untuk kebutuhan proyek dan pembelian eceran.',
                    'a_en' => 'Yes, PT. Anugerah Tama Sejati maintains ready stock at our Surabaya warehouse for immediate same-day dispatch and bulk delivery across Indonesia.'
                ],
            ],

            'schneider-electric-mcb-domae-1p-16a-6ka-domf01116' => [
                [
                    'q_id' => 'Apa perbedaan MCB Domae 6A dan 16A?',
                    'q_en' => 'What is the difference between Domae 6A and 16A MCB?',
                    'a_id' => 'Perbedaan utamanya ada pada arus pengenal (rated current) — 6A untuk beban ringan seperti lampu, sedangkan 16A untuk beban lebih besar seperti stop kontak daya atau sirkuit AC rumah tangga, dengan breaking capacity yang sama (<6kA).',
                    'a_en' => 'The primary difference is the rated current capacity: 6A is dedicated for low-load lighting, whereas 16A is built for power outlets and residential air conditioning, both sharing the same 6kA breaking capacity.'
                ],
                [
                    'q_id' => 'Untuk instalasi apa MCB 1P 16A paling cocok digunakan?',
                    'q_en' => 'Which installations are best suited for a 1P 16A MCB?',
                    'a_id' => 'MCB ini umum digunakan untuk sirkuit stop kontak rumah tangga, panel distribusi kecil, dan beban 1 fasa hingga sekitar 3.500VA pada tegangan 230V.',
                    'a_en' => 'This breaker is commonly used for branch socket circuits, compact distribution boards, and single-phase electrical loads up to approximately 3,500VA at 230V.'
                ],
                [
                    'q_id' => 'Apakah produk ini asli dan bergaransi resmi Schneider?',
                    'q_en' => 'Is this product genuine with official Schneider Electric warranty?',
                    'a_id' => 'Ya, seluruh produk Schneider yang dijual ATS Tekno adalah 100% original dengan Certificate of Origin dan garansi resmi manufaktur, karena ATS Tekno adalah Authorized Dealer Schneider Electric di Surabaya.',
                    'a_en' => 'Yes, every Schneider Electric component distributed by ATS Tekno is 100% authentic, accompanied by official manufacturer warranty and Certificate of Origin.'
                ],
                [
                    'q_id' => 'Bagaimana cara memesan MCB ini untuk kebutuhan proyek dalam jumlah besar?',
                    'q_en' => 'How can I place a bulk order for commercial projects?',
                    'a_id' => 'Anda dapat mengirimkan BoQ (Bill of Quantity) melalui WhatsApp atau email tim sales ATS Tekno untuk mendapatkan penawaran harga proyek dan konfirmasi stok.',
                    'a_en' => 'You can send your BoQ (Bill of Quantity) directly via WhatsApp or email to our sales engineering team for project pricing discounts and delivery schedules.'
                ],
            ],

            'schneider-electric-mccb-ezc100f-3p-100a-10ka-ezc100f3100' => [
                [
                    'q_id' => 'Apa perbedaan MCCB dan MCB?',
                    'q_en' => 'What is the key difference between MCCB and MCB?',
                    'a_id' => 'MCCB (Molded Case Circuit Breaker) dirancang untuk arus dan kapasitas pemutusan lebih besar dibanding MCB — MCCB EZC100F 3P 100A ini memiliki breaking capacity 10kA, jauh di atas MCB Domae yang hanya <6kA, sehingga cocok untuk main breaker panel industri.',
                    'a_en' => 'MCCBs are engineered for higher operating current and fault breaking capacities compared to MCBs. This EZC100F 3P 100A features a 10kA breaking capacity, making it suitable as a main incomer breaker for commercial and industrial switchboards.'
                ],
                [
                    'q_id' => 'Untuk aplikasi apa MCCB EZC100F 3P 100A digunakan?',
                    'q_en' => 'What are the primary applications of the EZC100F 3P 100A MCCB?',
                    'a_id' => 'Umumnya digunakan sebagai main breaker atau distribusi utama pada panel LVMDP/SDP industri, gedung komersial, dan sistem 3 fasa dengan beban hingga 100A.',
                    'a_en' => 'It is predominantly installed as main incomer or sub-distribution protection in industrial LVMDP, commercial building switchboards, and three-phase power distribution networks.'
                ],
                [
                    'q_id' => 'Apakah MCCB ini bisa disetel (adjustable trip)?',
                    'q_en' => 'Does this MCCB have adjustable trip settings?',
                    'a_id' => 'Spesifikasi standar EZC100F menggunakan trip unit thermal-magnetic fixed; untuk kebutuhan adjustable trip, konsultasikan varian EZC lain dengan tim engineering ATS Tekno.',
                    'a_en' => 'The standard EasyPact EZC100F utilizes a fixed thermal-magnetic trip unit. For adjustable trip thresholds, consult our engineering team for Compact NSX series alternatives.'
                ],
                [
                    'q_id' => 'Berapa lama waktu pengiriman jika stok tidak tersedia di Surabaya?',
                    'q_en' => 'What is the lead time if units require factory indent?',
                    'a_id' => 'Untuk SKU yang ready stock, pengiriman dari Surabaya biasanya 1–3 hari kerja ke seluruh Indonesia; untuk indent, tim sales akan menginformasikan estimasi waktu saat konfirmasi pesanan.',
                    'a_en' => 'Ready-stock units ship within 1–2 business days across East Java and nationwide. Indent orders typically follow official Schneider Electric supply timelines.'
                ],
            ],

            'schneider-electric-kontaktor-tesys-deca-3p-9a-4kw-220vac-lc1d09m7-deca' => [
                [
                    'q_id' => 'Apa fungsi kontaktor TeSys Deca dalam panel kontrol motor?',
                    'q_en' => 'What is the function of the TeSys Deca contactor in motor starter panels?',
                    'a_id' => 'Kontaktor TeSys Deca berfungsi sebagai saklar elektromagnetik untuk menghidupkan/mematikan motor listrik atau beban 3 fasa secara jarak jauh, biasanya dikendalikan oleh relay proteksi atau PLC.',
                    'a_en' => 'The TeSys Deca contactor acts as a robust electromechanical switch designed to remotely control and cycle electric motors and heavy inductive loads via automation controllers or pushbuttons.'
                ],
                [
                    'q_id' => 'Berapa kapasitas motor maksimal yang bisa dikontrol kontaktor 9A ini?',
                    'q_en' => 'What is the maximum motor rating controlled by this 9A contactor?',
                    'a_id' => 'Kontaktor LC1D09M7-DECA mampu mengontrol motor hingga 4kW pada tegangan 220-240V AC, sesuai kategori penggunaan AC-3 untuk motor squirrel-cage.',
                    'a_en' => 'The LC1D09M7-DECA contactor reliably switches 3-phase squirrel cage motors up to 4kW at 220-240V AC under AC-3 operational duty cycle.'
                ],
                [
                    'q_id' => 'Apakah kontaktor ini butuh auxiliary contact block tambahan?',
                    'q_en' => 'Does this contactor require additional auxiliary contact blocks?',
                    'a_id' => 'Untuk fungsi sinyal status (NO/NC) tambahan seperti indikator running/stop, Anda perlu auxiliary contact block terpisah (contoh: LADN11-DECA) yang kompatibel dengan seri TeSys Deca dan TeSys F.',
                    'a_en' => 'It includes 1NO + 1NC built-in auxiliary contacts. For additional interlocking or PLC feedback signals, modular add-on blocks like the LADN11-DECA can be clipped on without tools.'
                ],
                [
                    'q_id' => 'Apakah tersedia coil voltage selain 220VAC?',
                    'q_en' => 'Are other coil voltage variants available?',
                    'a_id' => 'Seri TeSys Deca tersedia dalam beberapa varian coil voltage (24VDC, 110VAC, 220VAC, dll); hubungi tim ATS Tekno untuk cek ketersediaan varian spesifik sesuai kebutuhan proyek Anda.',
                    'a_en' => 'Yes, TeSys Deca contactors are available in diverse coil ratings including 24V DC, 110V AC, and 380V AC. ATS Tekno stocks common control voltages in Surabaya.'
                ],
            ],

            'schneider-electric-kontaktor-tesys-deca-3p-32a-15kw-220vac-lc1d32m7-deca' => [
                [
                    'q_id' => 'Kapan harus menggunakan kontaktor 32A dibanding kontaktor 9A?',
                    'q_en' => 'When should you choose a 32A contactor over a 9A model?',
                    'a_id' => 'Pilih kontaktor 32A (LC1D32M7-DECA) untuk motor berdaya lebih besar, hingga 15kW pada 220-240V AC — jauh di atas kapasitas kontaktor 9A yang hanya untuk 4kW, sesuai perhitungan arus beban penuh motor Anda.',
                    'a_en' => 'Choose the 32A contactor (LC1D32M7) for electric motors rated up to 15kW at 220-240V AC (or 15kW at 380-415V), matching the full load current requirements of heavier industrial drives.'
                ],
                [
                    'q_id' => 'Apakah kontaktor ini cocok untuk aplikasi star-delta starter?',
                    'q_en' => 'Is this contactor suitable for star-delta starter circuits?',
                    'a_id' => 'Ya, kontaktor TeSys Deca kategori AC-3 umum digunakan dalam rangkaian star-delta starter, DOL starter, maupun sistem kontrol motor otomatis lainnya.',
                    'a_en' => 'Yes, TeSys Deca AC-3 contactors are widely deployed in Direct-On-Line (DOL), Star-Delta, and reversing motor starter panel configurations.'
                ],
                [
                    'q_id' => 'Berapa lama masa pakai (durability) kontaktor ini?',
                    'q_en' => 'What is the electrical and mechanical lifespan of this contactor?',
                    'a_id' => 'Kontaktor TeSys Deca dirancang dengan ketahanan mekanis dan elektris tinggi sesuai standar IEC 60947-4-1; untuk angka pasti life cycle, rujuk datasheet resmi Schneider Electric yang tersedia di halaman produk.',
                    'a_en' => 'It boasts up to 15 million mechanical switching cycles and up to 1.65 million electrical cycles at rated AC-3 duty, meeting rigorous IEC 60947-4-1 industrial standards.'
                ],
                [
                    'q_id' => 'Apakah harga kontaktor ini berbeda untuk pembelian retail vs proyek?',
                    'q_en' => 'Are tiered wholesale rates available for contractors and project orders?',
                    'a_id' => 'Ya, ATS Tekno menyediakan skema harga khusus untuk pembelian dalam jumlah besar/proyek; kirimkan BoQ Anda untuk mendapatkan penawaran harga terbaik.',
                    'a_en' => 'Yes, ATS Tekno provides contractor pricing tiers and wholesale B2B discounts for panel builders and EPC projects with tax invoice (PPN 11%) inclusion.'
                ],
            ],

            'schneider-electric-auxiliary-contact-block-for-tesys-deca-and-tesys-f-front-mounting-1no-1nc-ladn11-deca' => [
                [
                    'q_id' => 'Apa fungsi auxiliary contact block pada kontaktor?',
                    'q_en' => 'What is the purpose of an auxiliary contact block?',
                    'a_id' => 'Auxiliary contact block menambah kontak bantu (1NO+1NC pada LADN11-DECA) yang digunakan untuk sinyal indikasi status, interlocking antar kontaktor, atau input ke sistem kontrol/PLC.',
                    'a_en' => 'The auxiliary contact block clips onto a primary contactor to provide additional NO/NC signalling poles for electrical interlocking, indicator lamps, and PLC status feedback.'
                ],
                [
                    'q_id' => 'Apakah produk ini kompatibel dengan semua seri TeSys?',
                    'q_en' => 'Is this auxiliary block compatible across all TeSys series?',
                    'a_id' => 'LADN11-DECA dirancang khusus untuk front mounting pada TeSys Deca dan TeSys F — pastikan mencocokkan seri kontaktor Anda sebelum memesan agar dimensi dan mounting sesuai.',
                    'a_en' => 'The LADN11-DECA is specifically engineered for front-snap mounting onto Schneider TeSys Deca and TeSys D/F contactor chassis without screws.'
                ],
                [
                    'q_id' => 'Berapa konfigurasi kontak yang tersedia?',
                    'q_en' => 'What contact configuration does the LADN11 provide?',
                    'a_id' => 'Produk ini memiliki konfigurasi 1NO (Normally Open) + 1NC (Normally Closed); varian lain dengan konfigurasi berbeda tersedia dalam katalog Schneider — hubungi ATS Tekno untuk cek ketersediaan.',
                    'a_en' => 'This unit features 1 Normally Open (1NO) and 1 Normally Closed (1NC) instantaneous auxiliary contact poles.'
                ],
                [
                    'q_id' => 'Apakah perlu alat khusus untuk pemasangan auxiliary contact block ini?',
                    'q_en' => 'Are special tools required to mount this contact block?',
                    'a_id' => 'Tidak, komponen ini dirancang untuk pemasangan front-mounting langsung ke badan kontaktor tanpa alat khusus, mengikuti prosedur instalasi standar pada datasheet Schneider Electric.',
                    'a_en' => 'No special tools are needed. It features a patented clip-on latch that locks directly onto the front face of the contactor in seconds.'
                ],
            ],

            'schneider-electric-inverter-atv310-3p-1-5kw-2hp-380-460-vac-atv310hu15n4e' => [
                [
                    'q_id' => 'Apa fungsi inverter ATV310 dalam sistem otomasi industri?',
                    'q_en' => 'What is the role of the Altivar ATV310 inverter in industrial automation?',
                    'a_id' => 'Inverter ATV310 mengatur kecepatan putaran motor 3 fasa (Variable Frequency Drive/VFD) untuk efisiensi energi dan kontrol proses, umum digunakan pada pompa, fan, dan conveyor.',
                    'a_en' => 'The Altivar 310 (ATV310) is a Variable Frequency Drive (VFD) that controls 3-phase asynchronous motor speed, reducing energy consumption and mechanical stress on pumps, fans, and conveyors.'
                ],
                [
                    'q_id' => 'Berapa kapasitas motor maksimal yang bisa digerakkan inverter ini?',
                    'q_en' => 'What is the maximum motor output for the ATV310HU15N4E?',
                    'a_id' => 'ATV310HU15N4E mendukung motor hingga 1.5kW (2HP) pada tegangan 3 fasa 380-460V AC — pastikan rating motor Anda tidak melebihi kapasitas ini agar inverter bekerja optimal.',
                    'a_en' => 'The ATV310HU15N4E drive supports motors rated up to 1.5kW (2 Horsepower) with a 380V to 460V AC three-phase power supply.'
                ],
                [
                    'q_id' => 'Apakah ATV310 cocok untuk aplikasi pompa dan fan sederhana?',
                    'q_en' => 'Is the ATV310 suitable for straightforward fan and pump applications?',
                    'a_id' => 'Ya, seri ATV310 memang dirancang khusus untuk aplikasi mesin sederhana seperti pompa, fan, dan conveyor dengan kebutuhan kontrol kecepatan dasar, bukan aplikasi motion control kompleks.',
                    'a_en' => 'Yes, the ATV310 series is tailor-engineered for standard industrial machinery including blowers, HVAC fans, centrifugal pumps, and packaging conveyor systems.'
                ],
                [
                    'q_id' => 'Apakah tersedia panduan wiring/parameter setting inverter ini?',
                    'q_en' => 'Are wiring guides and programming manuals provided?',
                    'a_id' => 'Datasheet resmi dan manual programming tersedia melalui link download PDF pada halaman produk; untuk konsultasi setting parameter sesuai aplikasi, tim engineering ATS Tekno siap membantu via WhatsApp.',
                    'a_en' => 'Official quick-start guides and parameter programming manuals are available for download. Our certified panel engineers also provide commissioning guidance via WhatsApp.'
                ],
            ],

            'schneider-electric-pilot-lamp-monolitik-integral-led-220v-ac-hijau-xa2evm3lc' => [
                [
                    'q_id' => 'Apa fungsi pilot lamp pada panel kontrol?',
                    'q_en' => 'What is the function of a pilot indicator lamp on electrical panels?',
                    'a_id' => 'Pilot lamp berfungsi sebagai indikator visual status sistem — misalnya menyala hijau untuk kondisi normal/running, merah untuk fault/stop, atau jingga untuk warning — membantu operator memantau kondisi panel secara cepat.',
                    'a_en' => 'Pilot indicator lamps provide immediate visual confirmation of operating status—illuminating green for running/energized, red for stopped/tripped, or orange for standby/warning.'
                ],
                [
                    'q_id' => 'Apa arti standar warna merah, kuning/jingga, dan hijau pada indikator panel?',
                    'q_en' => 'What are the standardized color meanings for panel lamps?',
                    'a_id' => 'Secara umum, hijau menandakan sistem beroperasi normal (Running), kuning/jingga menandakan peringatan atau kondisi siaga, dan merah menandakan fault, trip, atau berhenti — mengikuti konvensi RST/RSTN yang umum di panel Indonesia.',
                    'a_en' => 'Under standard industrial conventions, Green signifies normal running, Amber/Orange indicates warning or standby conditions, and Red warns of fault or emergency shutdown.'
                ],
                [
                    'q_id' => 'Apakah pilot lamp ini menggunakan bohlam atau LED?',
                    'q_en' => 'Does this pilot lamp utilize incandescent bulbs or integral LED?',
                    'a_id' => 'Produk ini menggunakan integral LED monolitik pada tegangan 220V AC, lebih hemat energi dan tahan lama dibanding pilot lamp tipe bohlam konvensional.',
                    'a_en' => 'It utilizes an energy-efficient monolithic integral LED light block rated for 220V AC, delivering over 50,000 hours of continuous service life.'
                ],
                [
                    'q_id' => 'Bisakah pilot lamp ini dipasang langsung di pintu panel tanpa modifikasi?',
                    'q_en' => 'Does this lamp install into standard panel cutouts?',
                    'a_id' => 'Ya, pilot lamp monolitik Schneider dirancang untuk mounting langsung pada lubang standar 22mm di pintu panel, sesuai instalasi umum panel kontrol dan distribusi.',
                    'a_en' => 'Yes, Schneider Easy Harmony XA2 pilot lamps mount directly into universal 22mm panel door cutouts with a secure rear locking collar.'
                ],
            ],

            'schneider-electric-pilot-lamp-monolitik-integral-led-220v-ac-merah-xa2evm4lc' => [
                [
                    'q_id' => 'Apa fungsi pilot lamp merah pada panel kontrol?',
                    'q_en' => 'What is the role of a red indicator lamp on switchboards?',
                    'a_id' => 'Pilot lamp merah berfungsi sebagai indikator visual status fault, trip, atau mesin dalam kondisi berhenti darurat, memudahkan operator panel mendeteksi anomali seketika.',
                    'a_en' => 'The red indicator lamp acts as a prominent visual status alert for motor trip, circuit fault, or stopped conditions, enabling prompt troubleshooting by maintenance staff.'
                ],
                [
                    'q_id' => 'Berapa diameter cutout pintu panel yang dibutuhkan?',
                    'q_en' => 'What is the required panel door cutout diameter?',
                    'a_id' => 'Pilot lamp monolitik tipe XA2 ini dirancang untuk lubang bor standar industri berdiameter 22mm dengan ketebalan plat panel 1–6mm.',
                    'a_en' => 'It fits standard 22mm (7/8 inch) circular push-button cutouts on steel enclosures with plate thicknesses between 1mm and 6mm.'
                ],
                [
                    'q_id' => 'Apakah lampu ini membutuhkan trafo step-down tambahan?',
                    'q_en' => 'Does this unit require an external step-down transformer?',
                    'a_id' => 'Tidak, pilot lamp integral ini langsung dihubungkan ke sumber tegangan 220V AC tanpa memerlukan trafo tambahan atau resistor ballast eksternal.',
                    'a_en' => 'No. The XA2EVM4LC connects directly across 220V–240V AC lines without external ballast resistors or auxiliary power supplies.'
                ],
                [
                    'q_id' => 'Apakah ATS Tekno menyediakan varian warna lain untuk indikator RST 3 fasa?',
                    'q_en' => 'Does ATS Tekno supply matching colors for 3-phase R-S-T indicators?',
                    'a_id' => 'Ya, ATS Tekno menyediakan lengkap varian warna Merah (R), Kuning/Jingga (S), Hijau (T), serta Biru dan Putih untuk kebutuhan indikator fase panel 3 fasa.',
                    'a_en' => 'Yes, ATS Tekno maintains complete inventory of Red, Yellow/Orange, Green, Blue, and White lenses for 3-phase supply phase identification.'
                ],
            ],

            'schneider-electric-pilot-lamp-monolitik-integral-led-220v-ac-jingga-xa2evm5lc' => [
                [
                    'q_id' => 'Apa fungsi pilot lamp jingga/kuning pada panel listrik?',
                    'q_en' => 'What is the function of an amber/orange pilot lamp?',
                    'a_id' => 'Pilot lamp jingga/kuning umum digunakan sebagai indikator peringatan (warning), fase S pada sistem 3 fasa, atau penanda kondisi siaga (standby) sebelum mesin dihidupkan.',
                    'a_en' => 'The amber/orange lamp signifies caution, secondary phase (S-phase) monitoring in 3-phase supplies, or machinery in standby readiness mode.'
                ],
                [
                    'q_id' => 'Apakah tipe integral LED lebih tahan terhadap getaran mesin?',
                    'q_en' => 'Are integral LED indicator lamps vibration resistant?',
                    'a_id' => 'Ya, konstruksi monolitik LED solid-state jauh lebih tahan terhadap getaran panel industri dan benturan dibanding bohlam filamen kaca yang rentan putus.',
                    'a_en' => 'Yes, solid-state monolithic LEDs eliminate fragile glass filaments, delivering superior shock and vibration resistance in demanding factory environments.'
                ],
                [
                    'q_id' => 'Berapa rating proteksi IP untuk seri Schneider Easy Harmony XA2 ini?',
                    'q_en' => 'What is the ingress protection (IP) rating for the XA2 series?',
                    'a_id' => 'Seri XA2 memiliki rating perlindungan IP65 pada bagian depan, tahan terhadap debu industri dan semprotan air saat dipasang dengan gasket terpasang rapi.',
                    'a_en' => 'It features IP65 front-face ingress protection against particulate dust and water jets when mounted flush with the provided sealing washer.'
                ],
                [
                    'q_id' => 'Bagaimana cara pemesanan grosir untuk pembuatan panel listrik?',
                    'q_en' => 'How can panel builders purchase in bulk?',
                    'a_id' => 'Hubungi sales ATS Tekno via WhatsApp untuk mendapatkan harga distributor per kotak (box packaging) serta penawaran komponen pelengkap panel lainnya.',
                    'a_en' => 'Contact ATS Tekno sales via WhatsApp or email to access distributor box pricing and project bundling with pushbuttons and selector switches.'
                ],
            ],
        ];
    }

    /**
     * Article FAQ Definitions (AEO Optimized with 40-60 words self-contained opening answers).
     */
    public static function articleFaqs(): array
    {
        return [
            'bagaimana-cara-pasang-wall-charger-mobil-listrik-di-rumah-panduan-lengkap-dan-aman' => [
                [
                    'q_id' => 'Apakah instalasi wall charger mobil listrik bisa dilakukan sendiri di rumah?',
                    'q_en' => 'Can an EV home wall charger be installed as a DIY project?',
                    'a_id' => 'Sebaiknya tidak dilakukan sendiri tanpa keahlian kelistrikan — instalasi wall charger memerlukan perhitungan daya, grounding, dan proteksi (MCB/RCBO) sesuai standar PUIL, sehingga direkomendasikan menggunakan instalatir bersertifikat.',
                    'a_en' => 'EV wall chargers should not be installed as DIY work. Safety standards require professional capacity calculations, dedicated RCCB/RCBO protection, and verified grounding under national electrical safety codes.'
                ],
                [
                    'q_id' => 'Berapa daya listrik yang dibutuhkan untuk memasang home charger EV?',
                    'q_en' => 'What home electrical power capacity is required for an EV charger?',
                    'a_id' => 'Kebutuhan daya bervariasi tergantung tipe charger (umumnya 3.5kW–7kW untuk home charger AC), sehingga penambahan daya PLN mungkin diperlukan — konsultasikan kapasitas kWh rumah Anda sebelum instalasi.',
                    'a_en' => 'Standard residential AC wall chargers draw between 3.5kW (16A 1-phase) and 7.4kW (32A 1-phase) up to 22kW (3-phase), typically requiring an upgraded utility connection (PLN).'
                ],
                [
                    'q_id' => 'Komponen apa saja yang dibutuhkan untuk instalasi wall charger yang aman?',
                    'q_en' => 'What essential components make up a safe EV charging installation?',
                    'a_id' => 'Minimal dibutuhkan MCB/RCBO khusus sirkuit charger, kabel dengan ukuran sesuai arus beban, sistem grounding yang baik, dan panel distribusi terpisah agar tidak membebani sirkuit rumah lainnya.',
                    'a_en' => 'Essential protection components include a dedicated Type-A or Type-B RCBO/RCCB, appropriately sized copper conductor cables, an independent sub-panel, and a low-resistance earth rod.'
                ],
                [
                    'q_id' => 'Apakah wall charger butuh sistem grounding khusus?',
                    'q_en' => 'Does an EV wall charger require a dedicated grounding system?',
                    'a_id' => 'Ya, grounding yang baik wajib untuk keamanan wall charger EV karena mencegah risiko sengatan listrik dan melindungi kendaraan dari gangguan tegangan — dibahas detail pada artikel grounding terkait di blog ini.',
                    'a_en' => 'Yes, robust grounding is mandatory. Most modern EV on-board systems will refuse charging if the measured earth loop resistance exceeds strict threshold limits.'
                ],
            ],

            'cara-pasang-grounding-untuk-wall-charger-mobil-listrik-yang-aman-dan-benar' => [
                [
                    'q_id' => 'Mengapa grounding penting untuk wall charger mobil listrik?',
                    'q_en' => 'Why is earthing grounding critical for EV charging stations?',
                    'a_id' => 'Grounding melindungi pengguna dari risiko sengatan listrik dengan mengalirkan arus bocor ke tanah dengan aman, dan merupakan syarat wajib keselamatan pada instalasi kelistrikan berdaya tinggi seperti EV charger.',
                    'a_en' => 'Grounding safeguards users from electrical shock by safely dissipating residual fault currents into the earth and prevents voltage spikes from damaging delicate EV battery management electronics.'
                ],
                [
                    'q_id' => 'Berapa nilai resistansi grounding yang direkomendasikan?',
                    'q_en' => 'What is the recommended earth resistance value for EV installations?',
                    'a_id' => 'Standar umum mensyaratkan nilai resistansi grounding di bawah 5 ohm untuk instalasi rumah tangga/komersial, diukur menggunakan earth resistance tester sebelum sistem dioperasikan.',
                    'a_en' => 'Electrical safety guidelines (PUIL) strictly recommend earth loop resistance below 5 Ohms, confirmed via calibrated earth resistance tester measurements.'
                ],
                [
                    'q_id' => 'Apa saja komponen sistem grounding yang perlu disiapkan?',
                    'q_en' => 'What materials are needed to construct a proper earthing pit?',
                    'a_id' => 'Komponen dasar meliputi elektroda ground (ground rod), kabel BC (Bare Copper), clamp grounding, dan bak kontrol (control pit) untuk pengukuran berkala.',
                    'a_en' => 'Standard installation hardware comprises solid copper earth rods, Bare Copper (BC) grounding wire, brass compression clamps, and an inspection pit for routine testing.'
                ],
                [
                    'q_id' => 'Apakah grounding rumah biasa cukup untuk wall charger EV?',
                    'q_en' => 'Is an existing household ground sufficient for an EV charger?',
                    'a_id' => 'Belum tentu — grounding eksisting rumah perlu diukur ulang resistansinya; jika tidak memenuhi standar, diperlukan grounding tambahan khusus untuk sirkuit charger demi keamanan maksimal.',
                    'a_en' => 'Not necessarily. Aging household grounds frequently exceed 10–20 Ohms. Installing a dedicated low-resistance grounding rod ensures continuous, fault-free EV charging.'
                ],
            ],

            'apa-itu-saklar-clipsal-schneider-1-gang-1-arah-panduan-lengkap-fungsi-cara-kerja-dan-keunggulannya' => [
                [
                    'q_id' => 'Apa itu saklar Clipsal Schneider 1 gang 1 arah?',
                    'q_en' => 'What is a 1-gang 1-way Clipsal Schneider wall switch?',
                    'a_id' => 'Saklar 1 gang 1 arah adalah saklar dengan satu tombol yang mengendalikan satu titik lampu dari satu lokasi saja, berbeda dengan saklar 2 arah (hotel switch) yang bisa dikendalikan dari dua titik.',
                    'a_en' => 'A 1-gang 1-way switch features a single rocker switch mechanism that controls a dedicated lighting point from a single fixed wall location.'
                ],
                [
                    'q_id' => 'Apa perbedaan saklar 1 arah dan 2 arah (hotel switch)?',
                    'q_en' => 'What differentiates a 1-way switch from a 2-way hotel switch?',
                    'a_id' => 'Saklar 1 arah hanya bisa on/off dari satu titik saklar, sedangkan saklar 2 arah (three-way switch) memungkinkan lampu dikontrol dari dua lokasi berbeda, misalnya di tangga atau kamar dengan dua pintu akses.',
                    'a_en' => 'A 1-way switch turns circuits on and off from only one spot, whereas a 2-way (hotel) switch allows controlling a single light fixture from two distinct locations, such as top and bottom of staircases.'
                ],
                [
                    'q_id' => 'Untuk ruangan apa saklar 1 gang 1 arah paling cocok?',
                    'q_en' => 'Where are 1-gang 1-way switches best utilized?',
                    'a_id' => 'Cocok untuk ruangan dengan satu titik akses seperti kamar tidur kecil, gudang, atau ruangan yang lampunya hanya perlu dikendalikan dari satu posisi saklar.',
                    'a_en' => 'They are ideal for single-door rooms including bathrooms, small bedrooms, balconies, and storage closets where multi-point switching is unnecessary.'
                ],
                [
                    'q_id' => 'Apakah saklar Clipsal Schneider ini mudah dipasang sendiri?',
                    'q_en' => 'Is installation straightforward for residential rewiring?',
                    'a_id' => 'Pemasangan dasar tergolong sederhana bagi yang familiar dengan instalasi listrik rumah, namun tetap disarankan mematikan MCB terkait sebelum memasang dan menggunakan tenaga teknisi jika tidak yakin.',
                    'a_en' => 'Installation is straightforward using standard inbow wall boxes. Always isolate main breaker power prior to connecting live and load phase wires.'
                ],
            ],

            'mengenal-apa-itu-kabel-delta-liycy-fungsi-jenis-dan-spesifikasi-lengkap-kabel-delta-liycy-jz-3-x-1-mm2' => [
                [
                    'q_id' => 'Apa itu kabel Delta LIYCY dan untuk apa fungsinya?',
                    'q_en' => 'What is Delta LIYCY cable and how is it used?',
                    'a_id' => 'Kabel Delta LIYCY adalah kabel kontrol berperisai (shielded) yang digunakan untuk transmisi sinyal instrumentasi dan kontrol pada sistem otomasi industri, dengan perlindungan terhadap interferensi elektromagnetik (EMI).',
                    'a_en' => 'Delta LIYCY is a braided screened control cable engineered for sensitive signal transmission and industrial instrumentation, effectively deflecting electromagnetic interference (EMI).'
                ],
                [
                    'q_id' => 'Apa arti kode LIYCY-JZ pada kabel ini?',
                    'q_en' => 'What does the VDE code LIYCY-JZ stand for?',
                    'a_id' => 'Kode ini merujuk pada standar VDE Jerman — "LI" menandakan insulated conductor, "Y" untuk PVC, "C" untuk copper shielding, dan "Y" untuk PVC outer sheath, menunjukkan konstruksi kabel kontrol berperisai fleksibel.',
                    'a_en' => 'Under German DIN VDE standards: LI denotes stranded copper conductors, Y stands for PVC core insulation, C represents copper screen braid, and JZ indicates numbered black cores with yellow/green earth.'
                ],
                [
                    'q_id' => 'Untuk aplikasi apa kabel LIYCY 3x1mm² digunakan?',
                    'q_en' => 'What applications require 3x1mm² LIYCY cables?',
                    'a_id' => 'Cocok untuk wiring sinyal sensor, instrumentasi kontrol, dan koneksi PLC pada panel otomasi industri yang membutuhkan proteksi terhadap noise elektromagnetik.',
                    'a_en' => 'It connects industrial analog sensors (4-20mA / 0-10V), encoders, machine actuators, and PLC I/O racks situated near noisy variable speed drives.'
                ],
                [
                    'q_id' => 'Apa perbedaan kabel shielded seperti LIYCY dengan kabel kontrol biasa?',
                    'q_en' => 'How does shielded LIYCY compare to unshielded YY cables?',
                    'a_id' => 'Kabel shielded memiliki lapisan pelindung (shield) tambahan yang mengurangi gangguan sinyal dari sumber elektromagnetik di sekitarnya, penting untuk sinyal sensitif seperti sinyal analog 4-20mA pada instrumentasi.',
                    'a_en' => 'The tinned copper braid shield reflects radio frequency and motor drive harmonic noise, preventing corrupted sensor data that would cause industrial machine trips.'
                ],
            ],

            'apa-itu-temperature-controller-digital-dan-cara-kerja-autonics-tc4s-14r' => [
                [
                    'q_id' => 'Apa itu temperature controller digital?',
                    'q_en' => 'What is a digital temperature controller?',
                    'a_id' => 'Temperature controller digital adalah perangkat yang membaca sinyal dari sensor suhu (seperti thermocouple/RTD) dan mengatur output kontrol (relay/SSR) untuk menjaga suhu proses tetap sesuai setpoint yang ditentukan.',
                    'a_en' => 'A digital temperature controller reads temperature inputs from thermocouples or RTD sensors and computes control outputs (relay/SSR) to maintain a preset temperature setpoint.'
                ],
                [
                    'q_id' => 'Bagaimana cara kerja Autonics TC4S-14R secara umum?',
                    'q_en' => 'How does the Autonics TC4S-14R controller operate?',
                    'a_id' => 'TC4S-14R membaca input sensor suhu, membandingkannya dengan setpoint yang diprogram, lalu mengaktifkan output kontrol (relay) untuk menghidupkan/mematikan elemen pemanas atau pendingin guna menstabilkan suhu.',
                    'a_en' => 'The TC4S-14R utilizes single-display PID or ON/OFF control algorithms with a fast 100ms sampling cycle to trigger its internal 3A relay output for industrial heaters.'
                ],
                [
                    'q_id' => 'Untuk aplikasi apa temperature controller ini biasa digunakan?',
                    'q_en' => 'Which industries utilize the Autonics TC4S series?',
                    'a_id' => 'Umum digunakan pada mesin injection molding, oven industri, incubator, dan proses manufaktur lain yang membutuhkan kontrol suhu presisi.',
                    'a_en' => 'It is heavily utilized in plastic injection molding, industrial drying ovens, packaging heat sealers, and laboratory thermal incubators.'
                ],
                [
                    'q_id' => 'Jenis sensor apa yang kompatibel dengan Autonics TC4S-14R?',
                    'q_en' => 'Which temperature sensor inputs are compatible?',
                    'a_id' => 'Umumnya kompatibel dengan input thermocouple (tipe K umum digunakan) — periksa datasheet resmi Autonics untuk daftar lengkap tipe sensor yang didukung sebelum instalasi.',
                    'a_en' => 'It accepts standard universal inputs including Type K, J, and L thermocouples, as well as Pt100 (RTD) resistance temperature sensors.'
                ],
            ],

            'apa-fungsi-jenis-ukuran-dan-kegunaan-kabel-supreme-nyyhy' => [
                [
                    'q_id' => 'Apa itu kabel NYYHY dan apa fungsinya?',
                    'q_en' => 'What is Supreme NYYHY flexible cable and its primary function?',
                    'a_id' => 'Kabel NYYHY adalah kabel fleksibel berinti tembaga dengan isolasi dan sheath PVC, digunakan untuk instalasi listrik yang membutuhkan fleksibilitas tinggi seperti sambungan mesin bergerak atau panel yang sering dibongkar-pasang.',
                    'a_en' => 'NYYHY is a multi-core flexible copper cable insulated and sheathed with PVC, formulated for portable machinery, moving equipment, and flexible panel interconnections.'
                ],
                [
                    'q_id' => 'Apa perbedaan kabel NYYHY dengan kabel NYY biasa?',
                    'q_en' => 'What is the difference between flexible NYYHY and rigid NYY cables?',
                    'a_id' => 'Kabel NYYHY menggunakan konstruksi inti serabut halus (fine stranded) yang lebih fleksibel dibanding NYY yang bersifat lebih kaku, sehingga NYYHY lebih cocok untuk aplikasi yang membutuhkan gerakan/fleksibilitas.',
                    'a_en' => 'NYY uses solid or coarse stranded conductors suited for static underground conduit, whereas NYYHY features fine class-5 annealed copper strands that bend easily without fatigue.'
                ],
                [
                    'q_id' => 'Ukuran berapa saja kabel NYYHY yang tersedia?',
                    'q_en' => 'What common conductor cross-sections are available?',
                    'a_id' => 'Kabel NYYHY tersedia dalam berbagai ukuran penampang mulai dari kebutuhan kontrol kecil hingga daya menengah — cek halaman produk atau price list ATS Tekno untuk daftar ukuran lengkap yang ready stock.',
                    'a_en' => 'Supreme NYYHY is stocked by ATS Tekno from 2-core through 5-core varieties, spanning cross-sections of 0.75mm², 1.5mm², 2.5mm², up to 10mm² and 16mm².'
                ],
                [
                    'q_id' => 'Apakah kabel NYYHY cocok untuk instalasi outdoor?',
                    'q_en' => 'Is NYYHY suitable for direct outdoor or underground burial?',
                    'a_id' => 'Untuk instalasi outdoor/tertanam langsung disarankan menggunakan kabel dengan proteksi tambahan sesuai kondisi lingkungan; konsultasikan spesifikasi lingkungan instalasi Anda dengan tim teknis ATS Tekno.',
                    'a_en' => 'While its black PVC outer jacket offers light moisture resistance, direct underground burial requires rigid NYY or armored NYFGBY cables with mechanical conduit protection.'
                ],
            ],

            'apa-saja-warna-standar-kabel-di-indonesia' => [
                [
                    'q_id' => 'Apa standar warna kabel listrik di Indonesia?',
                    'q_en' => 'What are the official electrical cable color standards in Indonesia?',
                    'a_id' => 'Standar umum di Indonesia (mengacu PUIL) menggunakan merah/kuning/hitam untuk fasa (R/S/T), biru untuk netral, dan kuning-hijau untuk grounding/pembumian.',
                    'a_en' => 'Under Indonesian PUIL (General Electrical Installation Guidelines) and IEC harmonization: Phase conductors are Brown/Black/Grey (or Red/Yellow/Black legacy), Neutral is Light Blue, and Protective Earth is Green-Yellow.'
                ],
                [
                    'q_id' => 'Mengapa warna kabel listrik perlu distandarisasi?',
                    'q_en' => 'Why is electrical wire color coding standardized?',
                    'a_id' => 'Standarisasi warna kabel penting agar teknisi dapat mengidentifikasi fungsi setiap kabel dengan cepat dan aman saat instalasi atau perbaikan, mengurangi risiko kesalahan sambung yang bisa berbahaya.',
                    'a_en' => 'Color standardization enables electricians to instantly distinguish live phase, neutral return, and earth safety conductors, preventing electrocution hazards and catastrophic short circuits.'
                ],
                [
                    'q_id' => 'Kabel warna apa yang digunakan untuk grounding?',
                    'q_en' => 'What color is legally reserved for earthing grounding conductors?',
                    'a_id' => 'Kabel grounding/pembumian menggunakan warna kombinasi kuning-hijau (yellow-green), yang secara internasional maupun standar PUIL Indonesia dikhususkan hanya untuk fungsi ini dan tidak boleh digunakan untuk fasa atau netral.',
                    'a_en' => 'Green-Yellow striped insulation is legally reserved solely for Protective Earth (PE) ground conductors under both PUIL and international IEC 60446 regulations.'
                ],
                [
                    'q_id' => 'Apa yang terjadi jika warna kabel tidak sesuai standar saat instalasi?',
                    'q_en' => 'What risks occur when wiring colors disregard standard conventions?',
                    'a_id' => 'Ketidaksesuaian warna kabel bisa menyebabkan kesalahan identifikasi saat maintenance atau troubleshooting, meningkatkan risiko sengatan listrik atau korsleting — karena itu kepatuhan pada standar warna sangat penting untuk keselamatan kerja.',
                    'a_en' => 'Non-standard wiring leads to mistaken identity during panel maintenance, incorrect phase rotation in 3-phase machinery, short-circuit fire risks, and failure of official SLF electrical commissioning.'
                ],
            ],
        ];
    }
}
