<?php

namespace App\Services;

use App\Models\Brand;
use App\Models\MediaAsset;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSpecification;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProductExcelService
{
    /**
     * Canonical headers for products sheet.
     */
    public const PRODUCT_HEADERS = [
        'sku',
        'name',
        'short_description',
        'description_html',
        'brand_code',
        'category_codes',
        'primary_category_code',
        'slug',
        'meta_title',
        'meta_description',
        'status',
        'is_featured',
        'sort_order',
        'link_gdrive',
        'main_image_media_id',
        'image_alt',
        'gallery_links',
        'gallery_media_ids',
        'gallery_action',
    ];

    /**
     * Canonical headers for specifications sheet.
     */
    public const SPEC_HEADERS = [
        'sku',
        'attribute_code',
        'label',
        'value',
        'unit',
        'group',
        'sort_order',
        'operation',
    ];

    /**
     * Generate Excel template with instruction and lookup sheets.
     */
    public static function generateTemplate(): Spreadsheet
    {
        $spreadsheet = new Spreadsheet();

        // Sheet 1: products
        $sheetProducts = $spreadsheet->getActiveSheet();
        $sheetProducts->setTitle('products');
        $sheetProducts->freezePane('A2');

        $col = 1;
        foreach (self::PRODUCT_HEADERS as $header) {
            $sheetProducts->getCell([$col, 1])->setValueExplicit($header, DataType::TYPE_STRING);
            $sheetProducts->getColumnDimension(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col))->setAutoSize(true);
            $col++;
        }

        // Style headers
        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0F172A']],
            'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
        ];
        $sheetProducts->getStyle('A1:S1')->applyFromArray($headerStyle);
        $sheetProducts->getRowDimension(1)->setRowHeight(28);

        // Sheet 2: product_specifications
        $sheetSpecs = $spreadsheet->createSheet();
        $sheetSpecs->setTitle('product_specifications');
        $sheetSpecs->freezePane('A2');

        $col = 1;
        foreach (self::SPEC_HEADERS as $header) {
            $sheetSpecs->getCell([$col, 1])->setValueExplicit($header, DataType::TYPE_STRING);
            $sheetSpecs->getColumnDimension(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col))->setAutoSize(true);
            $col++;
        }
        $sheetSpecs->getStyle('A1:H1')->applyFromArray($headerStyle);
        $sheetSpecs->getRowDimension(1)->setRowHeight(28);

        // Sheet 3: _instructions
        $sheetInstructions = $spreadsheet->createSheet();
        $sheetInstructions->setTitle('_instructions');
        $sheetInstructions->setCellValue('A1', 'PANDUAN IMPOR PRODUK PT. ANUGERAH TAMA SEJATI');
        $sheetInstructions->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $instructions = [
            ['1. Kolom SKU', 'Wajib berupa teks (Text). Jangan gunakan format angka agar angka nol di depan dan tanda hubung tidak hilang.'],
            ['2. Mode Impor', 'Upsert (tambah baru atau perbarui), Create only (hanya tambah baru), Update only (hanya perbarui).'],
            ['3. Gambar Google Drive', 'Masukkan URL share file gambar Google Drive pada kolom link_gdrive. Gambar akan diunduh dan disimpan otomatis.'],
            ['4. Spesifikasi Teknis', 'Isi sheet product_specifications untuk atribut teknis fleksibel (arus nominal, tegangan, pole, dll).'],
            ['5. Sel Kosong vs __CLEAR__', 'Sel kosong pada update mempertahankan data lama. Ketik __CLEAR__ untuk mengosongkan nilai field opsional.'],
            ['6. Larangan Harga & Stok', 'Aplikasi ini adalah katalog murni. Kolom harga, diskon, dan stok tidak diproses.'],
        ];
        $r = 3;
        foreach ($instructions as $inst) {
            $sheetInstructions->setCellValue("A{$r}", $inst[0]);
            $sheetInstructions->setCellValue("B{$r}", $inst[1]);
            $sheetInstructions->getStyle("A{$r}")->getFont()->setBold(true);
            $r++;
        }
        $sheetInstructions->getColumnDimension('A')->setWidth(26);
        $sheetInstructions->getColumnDimension('B')->setWidth(90);

        // Sheet 4: _brands (Lookup)
        $sheetBrands = $spreadsheet->createSheet();
        $sheetBrands->setTitle('_brands');
        $sheetBrands->setCellValue('A1', 'brand_code');
        $sheetBrands->setCellValue('B1', 'brand_name');
        $sheetBrands->getStyle('A1:B1')->applyFromArray($headerStyle);
        $brands = Brand::active()->orderBy('name')->get();
        $r = 2;
        foreach ($brands as $brand) {
            $sheetBrands->setCellValueExplicit("A{$r}", $brand->code, DataType::TYPE_STRING);
            $sheetBrands->setCellValueExplicit("B{$r}", $brand->name, DataType::TYPE_STRING);
            $r++;
        }
        $sheetBrands->getColumnDimension('A')->setWidth(20);
        $sheetBrands->getColumnDimension('B')->setWidth(35);

        // Sheet 5: _categories (Lookup)
        $sheetCategories = $spreadsheet->createSheet();
        $sheetCategories->setTitle('_categories');
        $sheetCategories->setCellValue('A1', 'category_code');
        $sheetCategories->setCellValue('B1', 'category_name');
        $sheetCategories->getStyle('A1:B1')->applyFromArray($headerStyle);
        $categories = ProductCategory::active()->orderBy('name')->get();
        $r = 2;
        foreach ($categories as $cat) {
            $sheetCategories->setCellValueExplicit("A{$r}", $cat->code, DataType::TYPE_STRING);
            $sheetCategories->setCellValueExplicit("B{$r}", $cat->name, DataType::TYPE_STRING);
            $r++;
        }
        $sheetCategories->getColumnDimension('A')->setWidth(20);
        $sheetCategories->getColumnDimension('B')->setWidth(35);

        $spreadsheet->setActiveSheetIndex(0);

        return $spreadsheet;
    }

    /**
     * Export products into an XLSX spreadsheet conforming to the reusable schema.
     */
    public static function exportProducts($productsQuery = null): Spreadsheet
    {
        $spreadsheet = self::generateTemplate();
        $sheetProducts = $spreadsheet->getSheetByName('products');
        $sheetSpecs = $spreadsheet->getSheetByName('product_specifications');

        $products = $productsQuery ? $productsQuery->get() : Product::with(['brand', 'categories', 'primaryCategory', 'specifications', 'galleryUsages'])->get();

        $rowProd = 2;
        $rowSpec = 2;

        foreach ($products as $prod) {
            $categoryCodes = $prod->categories->pluck('code')->implode(';');
            $galleryIds = $prod->galleryUsages->pluck('media_id')->implode(';');

            $sheetProducts->setCellValueExplicit("A{$rowProd}", $prod->sku, DataType::TYPE_STRING);
            $sheetProducts->setCellValueExplicit("B{$rowProd}", $prod->name, DataType::TYPE_STRING);
            $sheetProducts->setCellValueExplicit("C{$rowProd}", (string) $prod->short_description, DataType::TYPE_STRING);
            $sheetProducts->setCellValueExplicit("D{$rowProd}", (string) $prod->description_html, DataType::TYPE_STRING);
            $sheetProducts->setCellValueExplicit("E{$rowProd}", (string) ($prod->brand ? $prod->brand->code : ''), DataType::TYPE_STRING);
            $sheetProducts->setCellValueExplicit("F{$rowProd}", $categoryCodes, DataType::TYPE_STRING);
            $sheetProducts->setCellValueExplicit("G{$rowProd}", (string) ($prod->primaryCategory ? $prod->primaryCategory->code : ''), DataType::TYPE_STRING);
            $sheetProducts->setCellValueExplicit("H{$rowProd}", $prod->slug, DataType::TYPE_STRING);
            $sheetProducts->setCellValueExplicit("I{$rowProd}", (string) $prod->meta_title, DataType::TYPE_STRING);
            $sheetProducts->setCellValueExplicit("J{$rowProd}", (string) $prod->meta_description, DataType::TYPE_STRING);
            $sheetProducts->setCellValueExplicit("K{$rowProd}", $prod->status, DataType::TYPE_STRING);
            $sheetProducts->setCellValueExplicit("L{$rowProd}", $prod->is_featured ? '1' : '0', DataType::TYPE_STRING);
            $sheetProducts->setCellValueExplicit("M{$rowProd}", (string) $prod->sort_order, DataType::TYPE_STRING);
            $sheetProducts->setCellValueExplicit("N{$rowProd}", '', DataType::TYPE_STRING); // link_gdrive left empty on export
            $sheetProducts->setCellValueExplicit("O{$rowProd}", (string) ($prod->main_image_id ?: ''), DataType::TYPE_STRING);
            $sheetProducts->setCellValueExplicit("P{$rowProd}", '', DataType::TYPE_STRING); // image_alt
            $sheetProducts->setCellValueExplicit("Q{$rowProd}", '', DataType::TYPE_STRING); // gallery_links left empty
            $sheetProducts->setCellValueExplicit("R{$rowProd}", $galleryIds, DataType::TYPE_STRING);
            $sheetProducts->setCellValueExplicit("S{$rowProd}", 'preserve', DataType::TYPE_STRING);

            $rowProd++;

            // Export specs
            foreach ($prod->specifications as $spec) {
                $sheetSpecs->setCellValueExplicit("A{$rowSpec}", $prod->sku, DataType::TYPE_STRING);
                $sheetSpecs->setCellValueExplicit("B{$rowSpec}", $spec->attribute_code, DataType::TYPE_STRING);
                $sheetSpecs->setCellValueExplicit("C{$rowSpec}", $spec->label, DataType::TYPE_STRING);
                $sheetSpecs->setCellValueExplicit("D{$rowSpec}", $spec->value, DataType::TYPE_STRING);
                $sheetSpecs->setCellValueExplicit("E{$rowSpec}", (string) $spec->unit, DataType::TYPE_STRING);
                $sheetSpecs->setCellValueExplicit("F{$rowSpec}", (string) $spec->group, DataType::TYPE_STRING);
                $sheetSpecs->setCellValueExplicit("G{$rowSpec}", (string) $spec->sort_order, DataType::TYPE_STRING);
                $sheetSpecs->setCellValueExplicit("H{$rowSpec}", 'upsert', DataType::TYPE_STRING);
                $rowSpec++;
            }
        }

        return $spreadsheet;
    }

    /**
     * Parse and validate an uploaded XLSX workbook, staging any Google Drive images.
     *
     * @return array [success => bool, summary => array, units => array, errors => array]
     */
    public static function parseAndValidate(string $filePath, string $mode = 'upsert', ?int $userId = null): array
    {
        @ini_set('memory_limit', '1024M');
        @set_time_limit(600);

        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($filePath);

        $sheetProducts = $spreadsheet->getSheetByName('products');
        if (!$sheetProducts) {
            return [
                'success' => false,
                'errors' => [[
                    'sheet' => 'workbook',
                    'row_number' => 0,
                    'sku' => '',
                    'field' => 'sheet',
                    'error_code' => 'MISSING_PRODUCTS_SHEET',
                    'error_message' => 'Workbook tidak memiliki sheet wajib bernama "products".',
                    'suggested_fix' => 'Gunakan template resmi dari tombol Unduh Template.',
                ]],
            ];
        }

        $allRows = $sheetProducts->toArray(null, true, false, false);
        if (empty($allRows)) {
            return [
                'success' => false,
                'errors' => [[
                    'sheet' => 'products',
                    'row_number' => 1,
                    'sku' => '',
                    'field' => 'sheet',
                    'error_code' => 'EMPTY_SHEET',
                    'error_message' => 'Sheet products kosong.',
                    'suggested_fix' => 'Isi data produk pada sheet products.',
                ]],
            ];
        }

        // 1. Read and map headers from first row
        $headerRow = $allRows[0];
        $headerMap = [];
        foreach ($headerRow as $colIdx => $headerVal) {
            $val = strtolower(trim((string) $headerVal));
            if (!empty($val)) {
                $normalizedHeader = match ($val) {
                    'reference_code' => 'sku',
                    'nama_produk' => 'name',
                    'deskripsi_produk' => 'description_html',
                    'gdrive', 'link_gdrive', 'link_foto', 'link_gambar', 'image_url', 'url_gambar', 'url_foto', 'foto', 'gambar', 'foto_produk', 'main_image' => 'link_gdrive',
                    'gallery', 'link_gallery', 'galeri', 'gallery_urls', 'foto_galeri', 'gambar_galeri' => 'gallery_links',
                    default => $val,
                };
                $headerMap[$normalizedHeader] = $colIdx;
            }
        }

        if (!isset($headerMap['sku'])) {
            return [
                'success' => false,
                'errors' => [[
                    'sheet' => 'products',
                    'row_number' => 1,
                    'sku' => '',
                    'field' => 'sku',
                    'error_code' => 'MISSING_SKU_HEADER',
                    'error_message' => 'Header "sku" tidak ditemukan pada sheet products baris pertama.',
                    'suggested_fix' => 'Tambahkan kolom dengan header "sku".',
                ]],
            ];
        }

        // Pre-fetch DB lookups into in-memory collections for fast matching
        $existingProducts = Product::all(['id', 'sku', 'normalized_sku', 'name', 'slug', 'status'])->keyBy('normalized_sku');
        $brandsByCode = Brand::all(['id', 'code'])->keyBy(fn($b) => strtoupper(trim((string) $b->code)));
        $categoriesByCode = ProductCategory::all(['id', 'code'])->keyBy(fn($c) => strtoupper(trim((string) $c->code)));

        $units = [];
        $errors = [];
        $seenSkus = [];
        $totalRows = count($allRows);

        // 2. Parse products rows
        for ($i = 1; $i < $totalRows; $i++) {
            $row = $i + 1;
            $rowCells = $allRows[$i];

            $rawSku = $rowCells[$headerMap['sku']] ?? null;

            // Ignore completely empty row
            if ($rawSku === null || trim((string) $rawSku) === '') {
                continue;
            }

            $sku = trim((string) $rawSku);
            $normalizedSku = Product::normalizeSku($sku);

            // Duplicate SKU detection in same workbook
            if (isset($seenSkus[$normalizedSku])) {
                $firstRow = $seenSkus[$normalizedSku];
                $errors[] = [
                    'sheet' => 'products',
                    'row_number' => $row,
                    'sku' => $sku,
                    'field' => 'sku',
                    'error_code' => 'DUPLICATE_SKU_IN_FILE',
                    'error_message' => "SKU '{$sku}' duplikat di dalam workbook (baris {$firstRow} dan baris {$row}).",
                    'suggested_fix' => 'Pastikan setiap SKU hanya muncul satu kali pada file Excel.',
                ];
                continue;
            }
            $seenSkus[$normalizedSku] = $row;

            // Extract row fields
            $rowData = [];
            foreach ($headerMap as $headerName => $colIdx) {
                $rowData[$headerName] = $rowCells[$colIdx] ?? null;
            }

            // Check existing product in DB
            $existingProduct = $existingProducts->get($normalizedSku);

            // Mode Validation
            if ($mode === 'create_only' && $existingProduct) {
                $errors[] = [
                    'sheet' => 'products',
                    'row_number' => $row,
                    'sku' => $sku,
                    'field' => 'sku',
                    'error_code' => 'SKU_ALREADY_EXISTS',
                    'error_message' => "SKU '{$sku}' sudah ada di database, tetapi mode impor adalah Create only.",
                    'suggested_fix' => 'Ganti mode ke Upsert atau Update only jika ingin memperbarui produk ini.',
                ];
                continue;
            }

            if ($mode === 'update_only' && !$existingProduct) {
                $errors[] = [
                    'sheet' => 'products',
                    'row_number' => $row,
                    'sku' => $sku,
                    'field' => 'sku',
                    'error_code' => 'SKU_NOT_FOUND',
                    'error_message' => "SKU '{$sku}' tidak ditemukan di database untuk mode Update only.",
                    'suggested_fix' => 'Ganti mode ke Upsert atau Create only untuk menambahkan produk baru.',
                ];
                continue;
            }

            // Name validation for create
            $nameVal = isset($rowData['name']) ? trim((string) $rowData['name']) : '';
            if (!$existingProduct && empty($nameVal)) {
                $errors[] = [
                    'sheet' => 'products',
                    'row_number' => $row,
                    'sku' => $sku,
                    'field' => 'name',
                    'error_code' => 'NAME_REQUIRED',
                    'error_message' => 'Nama produk wajib diisi untuk penambahan produk baru.',
                    'suggested_fix' => 'Isi kolom nama pada baris ini.',
                ];
                continue;
            }

            // Brand validation
            $brandId = null;
            if (!empty($rowData['brand_code'])) {
                $brandCode = strtoupper(trim((string) $rowData['brand_code']));
                if ($brandCode !== '__CLEAR__') {
                    $brand = $brandsByCode->get($brandCode);
                    if (!$brand) {
                        $errors[] = [
                            'sheet' => 'products',
                            'row_number' => $row,
                            'sku' => $sku,
                            'field' => 'brand_code',
                            'error_code' => 'BRAND_NOT_FOUND',
                            'error_message' => "Kode brand '{$brandCode}' tidak ditemukan di master Brand.",
                            'suggested_fix' => 'Daftarkan brand di menu Master Brand atau perbaiki kode.',
                        ];
                        continue;
                    }
                    $brandId = $brand->id;
                }
            }

            // Category validation
            $categoryIds = [];
            if (!empty($rowData['category_codes'])) {
                $catCodesStr = trim((string) $rowData['category_codes']);
                if ($catCodesStr !== '__CLEAR__') {
                    $codes = array_filter(array_map('trim', explode(';', $catCodesStr)));
                    $catError = false;
                    foreach ($codes as $cCode) {
                        $cat = $categoriesByCode->get(strtoupper($cCode));
                        if (!$cat) {
                            $errors[] = [
                                'sheet' => 'products',
                                'row_number' => $row,
                                'sku' => $sku,
                                'field' => 'category_codes',
                                'error_code' => 'CATEGORY_NOT_FOUND',
                                'error_message' => "Kode kategori '{$cCode}' tidak ditemukan di master Kategori Produk.",
                                'suggested_fix' => 'Daftarkan kategori di Master Kategori Produk atau perbaiki kode.',
                            ];
                            $catError = true;
                            break;
                        }
                        $categoryIds[] = $cat->id;
                    }
                    if ($catError) {
                        continue;
                    }
                }
            }

            // Primary category validation
            $primaryCategoryId = null;
            if (!empty($rowData['primary_category_code'])) {
                $pCode = strtoupper(trim((string) $rowData['primary_category_code']));
                $pCat = $categoriesByCode->get($pCode);
                if (!$pCat) {
                    $errors[] = [
                        'sheet' => 'products',
                        'row_number' => $row,
                        'sku' => $sku,
                        'field' => 'primary_category_code',
                        'error_code' => 'PRIMARY_CATEGORY_NOT_FOUND',
                        'error_message' => "Kode kategori utama '{$pCode}' tidak ditemukan.",
                        'suggested_fix' => 'Pastikan kode kategori utama valid dan terdaftar.',
                    ];
                    continue;
                }
                if (!in_array($pCat->id, $categoryIds, true) && !empty($categoryIds)) {
                    $errors[] = [
                        'sheet' => 'products',
                        'row_number' => $row,
                        'sku' => $sku,
                        'field' => 'primary_category_code',
                        'error_code' => 'PRIMARY_CATEGORY_NOT_IN_SET',
                        'error_message' => "Kategori utama '{$pCode}' harus termasuk dalam daftar category_codes.",
                        'suggested_fix' => 'Tambahkan kode kategori utama ke dalam kolom category_codes.',
                    ];
                    continue;
                }
                $primaryCategoryId = $pCat->id;
            } elseif (!empty($categoryIds)) {
                // Default primary category to first in list
                $primaryCategoryId = $categoryIds[0];
            }

            // Image validation (Drive link vs Media ID conflict)
            $linkGdrive = isset($rowData['link_gdrive']) ? trim((string) $rowData['link_gdrive']) : '';
            $mainMediaId = isset($rowData['main_image_media_id']) ? trim((string) $rowData['main_image_media_id']) : '';

            if (!empty($linkGdrive) && !empty($mainMediaId)) {
                $errors[] = [
                    'sheet' => 'products',
                    'row_number' => $row,
                    'sku' => $sku,
                    'field' => 'link_gdrive',
                    'error_code' => 'CONFLICTING_IMAGE_INPUT',
                    'error_message' => 'Kolom link_gdrive dan main_image_media_id tidak boleh diisi bersamaan.',
                    'suggested_fix' => 'Pilih salah satu metode pengisian gambar utama.',
                ];
                continue;
            }

            // Remote Download Staging for Main Image (Google Drive or Direct Web URL)
            $stagedMainImagePath = null;
            if (!empty($linkGdrive) && $linkGdrive !== '__CLEAR__') {
                $dlResult = DriveDownloadAdapter::downloadToStaging($linkGdrive);
                if (!$dlResult['success']) {
                    $errors[] = [
                        'sheet' => 'products',
                        'row_number' => $row,
                        'sku' => $sku,
                        'field' => 'link_gdrive',
                        'error_code' => $dlResult['error_code'],
                        'error_message' => 'Gagal mengunduh gambar utama: ' . $dlResult['error_message'],
                        'suggested_fix' => 'Pastikan URL gambar dapat diakses secara publik (contoh: https://listrikonline.com/... atau link share Google Drive).',
                    ];
                    continue;
                }
                $stagedMainImagePath = $dlResult['path'];
            }

            // Remote Download Staging for Gallery Images (Google Drive or Direct Web URLs separated by ; or ,)
            $stagedGalleryPaths = [];
            $galleryLinks = isset($rowData['gallery_links']) ? trim((string) $rowData['gallery_links']) : '';
            if (!empty($galleryLinks) && $galleryLinks !== '__CLEAR__') {
                $rawUrls = preg_split('/[;,\n\r]+/', $galleryLinks);
                foreach ($rawUrls as $rawUrl) {
                    $u = trim($rawUrl);
                    if (!empty($u)) {
                        $dlResult = DriveDownloadAdapter::downloadToStaging($u);
                        if ($dlResult['success']) {
                            $stagedGalleryPaths[] = $dlResult['path'];
                        }
                    }
                }
            }

            // Sanitization for description
            $descriptionHtml = isset($rowData['description_html']) ? (string) $rowData['description_html'] : null;
            if ($descriptionHtml !== null && $descriptionHtml !== '__CLEAR__') {
                $descriptionHtml = HtmlSanitizerService::clean($descriptionHtml);
            }

            $units[$normalizedSku] = [
                'row_number' => $row,
                'action' => $existingProduct ? 'update' : 'create',
                'sku' => $sku,
                'normalized_sku' => $normalizedSku,
                'valid' => true,
                'existing_id' => $existingProduct?->id,
                'data' => [
                    'name' => $nameVal ?: ($existingProduct ? $existingProduct->name : ''),
                    'short_description' => isset($rowData['short_description']) ? trim((string) $rowData['short_description']) : null,
                    'description_html' => $descriptionHtml,
                    'brand_id' => $brandId,
                    'category_ids' => $categoryIds,
                    'primary_category_id' => $primaryCategoryId,
                    'slug' => !empty($rowData['slug']) ? Str::slug($rowData['slug']) : ($existingProduct ? $existingProduct->slug : Str::slug(($nameVal ?: $sku) . '-' . $sku)),
                    'meta_title' => isset($rowData['meta_title']) ? trim((string) $rowData['meta_title']) : null,
                    'meta_description' => isset($rowData['meta_description']) ? trim((string) $rowData['meta_description']) : null,
                    'status' => in_array($rowData['status'] ?? '', ['draft', 'published', 'archived'], true) ? $rowData['status'] : ($existingProduct ? $existingProduct->status : 'published'),
                    'is_featured' => in_array($rowData['is_featured'] ?? '', ['1', 'true', 1, true], true),
                    'sort_order' => (int) ($rowData['sort_order'] ?? 0),
                    'main_image_media_id' => !empty($mainMediaId) && $mainMediaId !== '__CLEAR__' ? (int) $mainMediaId : null,
                    'staged_main_image_path' => $stagedMainImagePath,
                    'staged_gallery_paths' => $stagedGalleryPaths,
                    'image_alt' => isset($rowData['image_alt']) ? trim((string) $rowData['image_alt']) : null,
                    'gallery_action' => in_array($rowData['gallery_action'] ?? '', ['preserve', 'merge', 'replace', 'clear'], true) ? $rowData['gallery_action'] : 'preserve',
                    'raw_inputs' => $rowData,
                ],
                'specifications' => [],
            ];
        }

        // 3. Parse specifications sheet if available
        $sheetSpecs = $spreadsheet->getSheetByName('product_specifications');
        if ($sheetSpecs) {
            $allSpecRows = $sheetSpecs->toArray(null, true, false, false);
            $totalSpecRows = count($allSpecRows);
            $specSeenKeys = [];

            for ($j = 1; $j < $totalSpecRows; $j++) {
                $specRowCells = $allSpecRows[$j];
                $rowNum = $j + 1;

                $rawSku = $specRowCells[0] ?? null;
                if ($rawSku === null || trim((string) $rawSku) === '') {
                    continue;
                }

                $sku = trim((string) $rawSku);
                $normalizedSku = Product::normalizeSku($sku);

                if (!isset($units[$normalizedSku])) {
                    $errors[] = [
                        'sheet' => 'product_specifications',
                        'row_number' => $rowNum,
                        'sku' => $sku,
                        'field' => 'sku',
                        'error_code' => 'SPEC_PARENT_NOT_FOUND',
                        'error_message' => "SKU '{$sku}' pada sheet spesifikasi tidak ditemukan pada sheet products.",
                        'suggested_fix' => 'Pastikan SKU pada kedua sheet sama persis.',
                    ];
                    continue;
                }

                $attrCode = trim((string) ($specRowCells[1] ?? ''));
                if (empty($attrCode)) {
                    $errors[] = [
                        'sheet' => 'product_specifications',
                        'row_number' => $rowNum,
                        'sku' => $sku,
                        'field' => 'attribute_code',
                        'error_code' => 'MISSING_ATTRIBUTE_CODE',
                        'error_message' => 'Kolom attribute_code spesifikasi wajib diisi.',
                        'suggested_fix' => 'Isi kode atribut (misal: rated_current).',
                    ];
                    continue;
                }

                $specKey = $normalizedSku . '|' . $attrCode;
                if (isset($specSeenKeys[$specKey])) {
                    $errors[] = [
                        'sheet' => 'product_specifications',
                        'row_number' => $rowNum,
                        'sku' => $sku,
                        'field' => 'attribute_code',
                        'error_code' => 'DUPLICATE_SPEC_CODE',
                        'error_message' => "Spesifikasi '{$attrCode}' untuk SKU '{$sku}' duplikat di sheet spesifikasi.",
                        'suggested_fix' => 'Hanya cantumkan satu baris per attribute_code untuk setiap SKU.',
                    ];
                    continue;
                }
                $specSeenKeys[$specKey] = $rowNum;

                $units[$normalizedSku]['specifications'][] = [
                    'attribute_code' => $attrCode,
                    'label' => trim((string) ($specRowCells[2] ?? '')),
                    'value' => trim((string) ($specRowCells[3] ?? '')),
                    'unit' => trim((string) ($specRowCells[4] ?? '')),
                    'group' => trim((string) ($specRowCells[5] ?? '')),
                    'sort_order' => (int) ($specRowCells[6] ?? 0),
                    'operation' => trim((string) ($specRowCells[7] ?? '')) === 'remove' ? 'remove' : 'upsert',
                ];
            }
        }

        $createCount = 0;
        $updateCount = 0;
        foreach ($units as $u) {
            if ($u['action'] === 'create') {
                $createCount++;
            } else {
                $updateCount++;
            }
        }

        return [
            'success' => count($errors) === 0,
            'summary' => [
                'total_units' => count($units),
                'create_count' => $createCount,
                'update_count' => $updateCount,
                'error_count' => count($errors),
            ],
            'units' => $units,
            'errors' => $errors,
        ];
    }

    /**
     * Execute a validated import unit into database within a single unit transaction.
     */
    public static function executeUnit(array $unit, ?int $userId = null): array
    {
        return DB::transaction(function () use ($unit, $userId) {
            $data = $unit['data'] ?? $unit['payload'] ?? [];
            $sku = $unit['sku'] ?? ($data['sku'] ?? '');
            $normalizedSku = $unit['normalized_sku'] ?? ($data['normalized_sku'] ?? Product::normalizeSku($sku));
            $specifications = $unit['specifications'] ?? ($data['specifications'] ?? []);

            // 1. Process main image if staged
            $mainImageId = $data['main_image_media_id'] ?? null;
            if (!empty($data['staged_main_image_path']) && file_exists($data['staged_main_image_path'])) {
                $media = MediaService::storeStagedFile($data['staged_main_image_path'], "product_{$sku}.jpg", $userId);
                $mainImageId = $media->id;
            }

            // 2. Create or Update Product
            $product = Product::where('normalized_sku', $normalizedSku)->first();
            $actionTaken = 'unchanged';

            if (!$product) {
                $baseSlug = $data['slug'] ?? Str::slug(($data['name'] ?? $sku) . '-' . $sku);
                $slug = $baseSlug;
                $counter = 1;
                while (Product::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter++;
                }

                $status = $data['status'] ?? 'published';
                $publishedAt = ($status === 'published') ? now() : null;

                $product = Product::create([
                    'sku' => $sku,
                    'normalized_sku' => $normalizedSku,
                    'name' => $data['name'] ?? $sku,
                    'slug' => $slug,
                    'short_description' => $data['short_description'] ?? null,
                    'description_html' => $data['description_html'] ?? null,
                    'brand_id' => $data['brand_id'] ?? null,
                    'primary_category_id' => $data['primary_category_id'] ?? null,
                    'main_image_id' => $mainImageId,
                    'meta_title' => $data['meta_title'] ?? null,
                    'meta_description' => $data['meta_description'] ?? null,
                    'status' => $status,
                    'published_at' => $publishedAt,
                    'is_featured' => $data['is_featured'] ?? false,
                    'sort_order' => $data['sort_order'] ?? 0,
                    'created_by' => $userId,
                    'updated_by' => $userId,
                ]);
                $actionTaken = 'created';
            } else {
                $updates = [];
                if (array_key_exists('name', $data) && $data['name'] !== null) $updates['name'] = $data['name'];
                if (array_key_exists('short_description', $data)) $updates['short_description'] = $data['short_description'];
                if (array_key_exists('description_html', $data) && $data['description_html'] !== null) $updates['description_html'] = $data['description_html'];
                if (array_key_exists('brand_id', $data) && $data['brand_id'] !== null) $updates['brand_id'] = $data['brand_id'];
                if (array_key_exists('primary_category_id', $data) && $data['primary_category_id'] !== null) $updates['primary_category_id'] = $data['primary_category_id'];
                if ($mainImageId !== null) $updates['main_image_id'] = $mainImageId;
                if (array_key_exists('meta_title', $data)) $updates['meta_title'] = $data['meta_title'];
                if (array_key_exists('meta_description', $data)) $updates['meta_description'] = $data['meta_description'];
                if (array_key_exists('status', $data) && $data['status'] !== null) {
                    $updates['status'] = $data['status'];
                    if ($data['status'] === 'published' && !$product->published_at) {
                        $updates['published_at'] = now();
                    }
                }
                if (array_key_exists('is_featured', $data)) $updates['is_featured'] = $data['is_featured'];
                if (array_key_exists('sort_order', $data)) $updates['sort_order'] = $data['sort_order'];

                if (!empty($updates)) {
                    $updates['updated_by'] = $userId;
                    $product->update($updates);
                    $actionTaken = 'updated';
                }
            }

            // 3. Process Categories
            if (!empty($data['category_ids'])) {
                $product->categories()->sync($data['category_ids']);
            }

            // 4. Process Specifications
            if (!empty($specifications)) {
                foreach ($specifications as $spec) {
                    if (($spec['operation'] ?? 'upsert') === 'remove') {
                        ProductSpecification::where('product_id', $product->id)
                            ->where('attribute_code', $spec['attribute_code'])
                            ->delete();
                    } else {
                        ProductSpecification::updateOrCreate(
                            ['product_id' => $product->id, 'attribute_code' => $spec['attribute_code']],
                            [
                                'label' => $spec['label'] ?? $spec['attribute_code'],
                                'value' => $spec['value'] ?? '',
                                'unit' => $spec['unit'] ?? null,
                                'group' => $spec['group'] ?? null,
                                'sort_order' => (int) ($spec['sort_order'] ?? 0),
                            ]
                        );
                    }
                }
            }

            // 5. Process Gallery Images if staged
            if (!empty($data['staged_gallery_paths']) && is_array($data['staged_gallery_paths'])) {
                $galleryAction = $data['gallery_action'] ?? 'merge';
                if ($galleryAction === 'replace' || $galleryAction === 'clear') {
                    $product->galleryUsages()->delete();
                }
                if ($galleryAction !== 'clear') {
                    $currentMax = (int) $product->galleryUsages()->max('sort_order');
                    foreach ($data['staged_gallery_paths'] as $gIdx => $gPath) {
                        if (file_exists($gPath)) {
                            $currentMax++;
                            $gMedia = MediaService::storeStagedFile($gPath, "product_{$sku}_gallery_{$currentMax}.jpg", $userId);
                            MediaService::attach($gMedia->id, Product::class, $product->id, 'gallery', $currentMax, $product->name);
                        }
                    }
                }
            }

            return [
                'success' => true,
                'action' => $actionTaken,
                'product_id' => $product->id,
                'sku' => $sku,
            ];
        });
    }

    /**
     * Generate an Excel error report workbook.
     */
    public static function generateErrorReport(array $errors): Spreadsheet
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('error_report');
        $sheet->freezePane('A2');

        $headers = ['sheet', 'row_number', 'sku', 'field', 'error_code', 'error_message', 'suggested_fix'];
        $col = 1;
        foreach ($headers as $h) {
            $sheet->getCell([$col, 1])->setValueExplicit($h, DataType::TYPE_STRING);
            $sheet->getColumnDimension(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col))->setAutoSize(true);
            $col++;
        }

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'DC2626']],
            'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
        ];
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(26);

        $row = 2;
        foreach ($errors as $err) {
            $sheet->setCellValueExplicit("A{$row}", $err['sheet'] ?? '', DataType::TYPE_STRING);
            $sheet->setCellValueExplicit("B{$row}", (string) ($err['row_number'] ?? ''), DataType::TYPE_STRING);
            $sheet->setCellValueExplicit("C{$row}", $err['sku'] ?? '', DataType::TYPE_STRING);
            $sheet->setCellValueExplicit("D{$row}", $err['field'] ?? '', DataType::TYPE_STRING);
            $sheet->setCellValueExplicit("E{$row}", $err['error_code'] ?? '', DataType::TYPE_STRING);
            $sheet->setCellValueExplicit("F{$row}", $err['error_message'] ?? '', DataType::TYPE_STRING);
            $sheet->setCellValueExplicit("G{$row}", $err['suggested_fix'] ?? '', DataType::TYPE_STRING);
            $row++;
        }

        return $spreadsheet;
    }
}
