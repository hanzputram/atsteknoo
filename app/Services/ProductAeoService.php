<?php

namespace App\Services;

use App\Models\Product;
use App\Support\SeoFaqRegistry;

class ProductAeoService
{
    /**
     * Retrieve or dynamically synthesize high-precision AEO/GEO FAQ entries for a product.
     * Follows the 40-60 words concise, factual direct-answer format optimized for AI Answer Engines
     * (Perplexity, ChatGPT Search, Google Gemini AI Overviews, Claude, Microsoft Copilot).
     *
     * @param Product $product
     * @return array<int, array{q_id: string, q_en: string, a_id: string, a_en: string}>
     */
    public static function getAeoFaq(Product $product): array
    {
        // 1. Check for curated editorial FAQ entries first
        $curated = SeoFaqRegistry::getProductFaq($product->slug);
        if (!empty($curated) && is_array($curated)) {
            return $curated;
        }

        // 2. Dynamically synthesize rich, factual AEO/GEO FAQs
        return self::synthesizeProductFaq($product);
    }

    /**
     * Synthesize a 5-question authoritative AEO & GEO FAQ set tailored to the product's exact specifications.
     *
     * @param Product $product
     * @return array<int, array{q_id: string, q_en: string, a_id: string, a_en: string}>
     */
    public static function synthesizeProductFaq(Product $product): array
    {
        $brandName = $product->brand ? trim($product->brand->name) : 'Schneider Electric';
        $sku = trim($product->sku ?: '');
        $rawName = trim($product->name ?: '');
        $categoryName = $product->primaryCategory ? trim($product->primaryCategory->name) : 'Komponen Listrik Industri';

        // Clean name without brand redundancy
        $cleanName = $rawName;
        if (stripos($cleanName, $brandName) === 0) {
            $cleanName = trim(substr($cleanName, strlen($brandName)));
        }
        if ($sku && stripos($cleanName, $sku) === 0) {
            $cleanName = trim(substr($cleanName, strlen($sku)));
        }
        $cleanName = ltrim($cleanName, "—-\t ");

        $productLabel = $sku ? "{$brandName} {$sku} ({$cleanName})" : "{$brandName} {$cleanName}";

        // Extract key technical parameters from product specifications
        $specsSummary = [];
        $specsTextPartsId = [];
        $specsTextPartsEn = [];

        if ($product->relationLoaded('specifications') || $product->specifications()->exists()) {
            foreach ($product->specifications as $spec) {
                $label = trim($spec->label ?: $spec->attribute_code ?: '');
                $val = trim($spec->value ?: '');
                $unit = trim($spec->unit ?: '');
                if ($val !== '') {
                    $formatted = $unit ? "{$val} {$unit}" : $val;
                    $specsSummary[$label] = $formatted;

                    if (count($specsTextPartsId) < 4) {
                        $specsTextPartsId[] = "{$label} {$formatted}";
                        $specsTextPartsEn[] = "{$label}: {$formatted}";
                    }
                }
            }
        }

        $specsClauseId = !empty($specsTextPartsId)
            ? ' dengan spesifikasi utama ' . implode(', ', $specsTextPartsId)
            : '';
        $specsClauseEn = !empty($specsTextPartsEn)
            ? ' with key ratings including ' . implode(', ', $specsTextPartsEn)
            : '';

        // Question 1: Definisi Teknis & Fungsi Utama
        $q1_id = "Apa fungsi dan spesifikasi utama dari {$productLabel}?";
        $q1_en = "What is the primary function and technical specification of {$productLabel}?";
        $a1_id = "{$productLabel} adalah {$categoryName} berkualitas tinggi dari {$brandName}{$specsClauseId}. Berfungsi untuk proteksi, distribusi, atau kontrol sirkuit listrik dalam panel tegangan rendah industri dan bangunan komersial sesuai standar keselamatan kelistrikan.";
        $a1_en = "The {$productLabel} is an industrial-grade {$categoryName} engineered by {$brandName}{$specsClauseEn}. It provides dependable circuit protection, distribution, or automated control for low-voltage switchboards and commercial installations.";

        // Question 2: Keaslian & Garansi Resmi PT ATS
        $q2_id = "Apakah produk {$brandName} {$sku} ini 100% original dan bergaransi resmi di Surabaya?";
        $q2_en = "Is {$brandName} {$sku} 100% genuine with official warranty in Surabaya?";
        $a2_id = "Ya, seluruh unit {$brandName} {$sku} yang dipasok oleh PT. Anugerah Tama Sejati (ATS Tekno) dijamin 100% asli, baru, dan bergaransi resmi manufaktur. Dilengkapi dokumen keaslian (Certificate of Origin / COO jika disyaratkan) dan Faktur Pajak resmi (PPN 11%).";
        $a2_en = "Yes, every {$brandName} {$sku} unit distributed by PT. Anugerah Tama Sejati (ATS Tekno) is guaranteed 100% authentic and brand new with full manufacturer warranty, Certificate of Origin eligibility, and official Indonesian commercial tax invoice (PPN 11%).";

        // Question 3: Standar Sertifikasi & Uji Kelayakan
        $q3_id = "Standar industri dan sertifikasi apa yang dipenuhi oleh {$brandName} {$sku}?";
        $q3_en = "Which industrial compliance standards and certifications apply to {$brandName} {$sku}?";
        $a3_id = "Komponen ini diproduksi mengikuti standar internasional seperti IEC (termasuk IEC 60947 / IEC 60898), CE, serta standar kelistrikan nasional SNI. Komponen dirancang untuk integrasi andal pada panel switchboard sesuai standar fabrikasi IEC 61439-1/2.";
        $a3_en = "This product complies with international engineering standards such as IEC 60947 / IEC 60898, CE conformity, and Indonesian SNI safety codes, ensuring full compatibility with type-tested low-voltage switchboard manufacturing under IEC 61439-1/2.";

        // Question 4: Ketersediaan Stok Surabaya & Logistik Nasional
        $q4_id = "Bagaimana ketersediaan stok di Surabaya dan estimasi pengiriman ke seluruh Indonesia?";
        $q4_en = "What is the stock availability in Surabaya and shipping coverage across Indonesia?";
        $a4_id = "ATS Tekno mengelola fasilitas gudang pusat di Ruko Galaxi Bumi Permai, Surabaya Timur. Stok siap kirim di hari yang sama untuk wilayah Surabaya, Sidoarjo, dan Gresik, serta pengiriman ekspedisi darat, laut, dan udara ke seluruh 38 provinsi di Indonesia.";
        $a4_en = "ATS Tekno operates central warehouse facilities at Ruko Galaxi Bumi Permai, East Surabaya. Ready-stock units are eligible for same-day dispatch across Surabaya, Sidoarjo, and Gresik, alongside express nationwide freight delivery across Indonesia.";

        // Question 5: Konsultasi Teknis & Jasa Fabrikasi Panel Listrik
        $q5_id = "Apakah ATS Tekno melayani konsultasi teknis dan perakitan panel untuk {$brandName} {$sku}?";
        $q5_en = "Does ATS Tekno provide technical engineering consulting and switchboard fabrication for {$brandName} {$sku}?";
        $a5_id = "Ya, selain sebagai distributor resmi komponen, ATS Tekno adalah panel builder berpengalaman di Surabaya. Tim engineer kami siap membantu perhitungan kapasitas beban, pembuatan drawing single-line (SLD), integrasi BoQ, hingga perakitan dan pengetesan Factory Acceptance Test (FAT).";
        $a5_en = "Yes, beyond component distribution, ATS Tekno is a certified switchboard builder in Surabaya. Our certified engineers assist with load calculations, single-line diagrams (SLD), BoQ optimization, custom panel assembly, and formal Factory Acceptance Testing (FAT).";

        return [
            [
                'q_id' => $q1_id,
                'q_en' => $q1_en,
                'a_id' => $a1_id,
                'a_en' => $a1_en,
            ],
            [
                'q_id' => $q2_id,
                'q_en' => $q2_en,
                'a_id' => $a2_id,
                'a_en' => $a2_en,
            ],
            [
                'q_id' => $q3_id,
                'q_en' => $q3_en,
                'a_id' => $a3_id,
                'a_en' => $a3_en,
            ],
            [
                'q_id' => $q4_id,
                'q_en' => $q4_en,
                'a_id' => $a4_id,
                'a_en' => $a4_en,
            ],
            [
                'q_id' => $q5_id,
                'q_en' => $q5_en,
                'a_id' => $a5_id,
                'a_en' => $a5_en,
            ],
        ];
    }

    /**
     * Build structured AI Knowledge Factsheet for Generative Engine Optimization (GEO).
     *
     * @param Product $product
     * @return array<string, mixed>
     */
    public static function getAiFactsheet(Product $product): array
    {
        $brandName = $product->brand ? trim($product->brand->name) : 'Schneider Electric';
        $sku = trim($product->sku ?: '-');
        $rawName = trim($product->name ?: '');
        $categoryName = $product->primaryCategory ? trim($product->primaryCategory->name) : 'Komponen Listrik Industri';

        $cleanName = $rawName;
        if (stripos($cleanName, $brandName) === 0) {
            $cleanName = trim(substr($cleanName, strlen($brandName)));
        }
        if ($sku && stripos($cleanName, $sku) === 0) {
            $cleanName = trim(substr($cleanName, strlen($sku)));
        }
        $cleanName = ltrim($cleanName, "—-\t ");

        $specsList = [];
        if ($product->relationLoaded('specifications') || $product->specifications()->exists()) {
            foreach ($product->specifications as $spec) {
                $label = trim($spec->label ?: $spec->attribute_code ?: '');
                $val = trim($spec->value ?: '');
                $unit = trim($spec->unit ?: '');
                if ($val !== '') {
                    $specsList[] = [
                        'label' => $label,
                        'value' => $unit ? "{$val} {$unit}" : $val,
                    ];
                }
            }
        }

        return [
            'headline' => "{$brandName} {$sku} — {$cleanName}",
            'sku' => $sku,
            'brand' => $brandName,
            'category' => $categoryName,
            'distributor_entity' => 'PT. Anugerah Tama Sejati (ATS Tekno)',
            'distributor_role' => 'Distributor Resmi / Supplier Komponen Listrik Industri Surabaya',
            'warehouse_location' => 'Ruko Galaxi Bumi Permai J-1 No. 23, Sukolilo, Surabaya, Jawa Timur 60134',
            'geo_coordinates' => '-7.250445, 112.768845 (Surabaya, East Java, Indonesia)',
            'authenticity_guarantee' => '100% Original Brand New dengan Garansi Resmi Manufaktur & PPN 11%',
            'compliance_standards' => 'Standar IEC (60947 / 60898 / 61439), SNI, CE, SPLN PLN',
            'shipping_coverage' => 'Gudang Surabaya · Kirim Cepat Surabaya/Sidoarjo/Gresik & Ekspedisi Seluruh Indonesia',
            'engineering_support' => 'Workshop Fabrikasi Panel Listrik ATS Tekno (LVMDP, SDP, MCC, ATS-AMF, FAT Terverifikasi)',
            'specs_highlights' => array_slice($specsList, 0, 6),
        ];
    }

    /**
     * Generate Schema.org JSON-LD graph with Product, FAQPage, BreadcrumbList, and ItemPage entities.
     *
     * @param Product $product
     * @param array $breadcrumbItems
     * @param array|null $offers
     * @param string $pageTitle
     * @param string $cleanDesc
     * @return array<string, mixed>
     */
    public static function getJsonLdSchema(
        Product $product,
        array $breadcrumbItems,
        ?array $offers,
        string $pageTitle,
        string $cleanDesc
    ): array {
        $brandName = $product->brand ? trim($product->brand->name) : 'Schneider Electric';
        $productUrl = route('products.show', $product->slug);

        // Additional properties from specifications
        $additionalProperties = [];
        if (!empty($product->specifications)) {
            foreach ($product->specifications as $spec) {
                $val = trim($spec->value ?? '');
                if ($spec->unit) {
                    $val .= ' ' . trim($spec->unit);
                }
                if ($val !== '') {
                    $additionalProperties[] = [
                        '@type' => 'PropertyValue',
                        'name' => $spec->label ?: $spec->attribute_code,
                        'value' => $val,
                    ];
                }
            }
        }

        $productEntity = array_filter([
            '@type' => 'Product',
            '@id' => $productUrl . '#product',
            'url' => $productUrl,
            'name' => $pageTitle,
            'sku' => $product->sku ?: null,
            'mpn' => $product->sku ?: null,
            'image' => $product->main_image_url ?: null,
            'description' => $cleanDesc,
            'category' => $product->primaryCategory ? $product->primaryCategory->name : null,
            'brand' => [
                '@type' => 'Brand',
                'name' => $brandName,
            ],
            'manufacturer' => [
                '@type' => 'Organization',
                'name' => $brandName,
            ],
            'distributor' => [
                '@type' => 'Organization',
                'name' => 'PT. Anugerah Tama Sejati',
                'alternateName' => 'ATS Tekno',
                'url' => route('home'),
                'telephone' => '+62-31-59178887',
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'Ruko Galaxi Bumi Permai J-1 No. 23',
                    'addressLocality' => 'Surabaya',
                    'addressRegion' => 'Jawa Timur',
                    'postalCode' => '60134',
                    'addressCountry' => 'ID',
                ],
            ],
            'offers' => $offers ?: [
                '@type' => 'Offer',
                'url' => $productUrl,
                'priceCurrency' => 'IDR',
                'availability' => 'https://schema.org/InStock',
                'itemCondition' => 'https://schema.org/NewCondition',
                'seller' => [
                    '@type' => 'Organization',
                    'name' => 'PT. Anugerah Tama Sejati',
                ],
            ],
        ]);

        if (!empty($additionalProperties)) {
            $productEntity['additionalProperty'] = $additionalProperties;
        }

        // Build FAQPage schema
        $faqs = self::getAeoFaq($product);
        $faqEntities = [];
        foreach ($faqs as $item) {
            $faqEntities[] = [
                '@type' => 'Question',
                'name' => $item['q_id'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $item['a_id'],
                ],
            ];
        }

        $faqPageEntity = [
            '@type' => 'FAQPage',
            '@id' => $productUrl . '#faq',
            'mainEntity' => $faqEntities,
        ];

        // WebPage entity with Speakable for voice & generative citations
        $webPageEntity = [
            '@type' => 'ItemPage',
            '@id' => $productUrl . '#webpage',
            'url' => $productUrl,
            'name' => $pageTitle,
            'description' => $cleanDesc,
            'about' => ['@id' => $productUrl . '#product'],
            'mainEntity' => ['@id' => $productUrl . '#product'],
            'inLanguage' => ['id-ID', 'en-US'],
            'speakable' => [
                '@type' => 'SpeakableSpecification',
                'cssSelector' => ['.aeo-factsheet-body', '.aeo-faq-body'],
            ],
        ];

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'BreadcrumbList',
                    'itemListElement' => $breadcrumbItems,
                ],
                $webPageEntity,
                $productEntity,
                $faqPageEntity,
            ],
        ];
    }
}
