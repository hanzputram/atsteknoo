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
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;
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
        'link_datasheet',
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
        $sheetProducts->getStyle('A1:T1')->applyFromArray($headerStyle);
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
        $sheetSpecs->getStyle('A1:G1')->applyFromArray($headerStyle);
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
            ['4. Link Datasheet', 'Masukkan URL file PDF datasheet (Google Drive atau URL langsung) pada kolom link_datasheet. File PDF dapat langsung dibuka/diunduh di halaman detail produk.'],
            ['5. Spesifikasi Teknis', 'Isi sheet product_specifications untuk atribut teknis fleksibel (arus nominal, tegangan, pole, dll).'],
            ['6. Sel Kosong vs __CLEAR__', 'Sel kosong pada update mempertahankan data lama. Ketik __CLEAR__ untuk mengosongkan nilai field opsional.'],
            ['7. Larangan Harga & Stok', 'Aplikasi ini adalah katalog murni. Kolom harga, diskon, dan stok tidak diproses.'],
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
        @ini_set('memory_limit', '1024M');
        @set_time_limit(300);

        $spreadsheet = self::generateTemplate();
        $sheetProducts = $spreadsheet->getSheetByName('products');
        $sheetSpecs = $spreadsheet->getSheetByName('product_specifications');

        // Disable autosize to optimize writer performance on large datasets
        foreach (range('A', 'T') as $col) {
            $sheetProducts->getColumnDimension($col)->setAutoSize(false)->setWidth(20);
        }
        foreach (range('A', 'G') as $col) {
            $sheetSpecs->getColumnDimension($col)->setAutoSize(false)->setWidth(20);
        }

        $products = $productsQuery ? $productsQuery->get() : Product::with(['brand', 'categories', 'primaryCategory', 'specifications', 'galleryUsages'])->get();

        $prodRows = [];
        $specRows = [];

        foreach ($products as $prod) {
            $categoryCodes = $prod->categories->pluck('code')->implode(';');
            $galleryIds = $prod->galleryUsages->pluck('media_id')->implode(';');
            $datasheetExportUrl = (string) ($prod->datasheet_url ?: ($prod->datasheet_id ? url('/media/' . $prod->datasheet_id) : ''));
            $imageExportUrl = (string) ($prod->image_url ?: '');

            $prodRows[] = [
                (string) $prod->sku,
                (string) $prod->name,
                (string) $prod->short_description,
                (string) $prod->description_html,
                (string) ($prod->brand ? $prod->brand->code : ''),
                $categoryCodes,
                (string) ($prod->primaryCategory ? $prod->primaryCategory->code : ''),
                (string) $prod->slug,
                (string) $prod->meta_title,
                (string) $prod->meta_description,
                (string) $prod->status,
                $prod->is_featured ? '1' : '0',
                (string) $prod->sort_order,
                $imageExportUrl, // link_gdrive / image url
                $datasheetExportUrl, // link_datasheet
                (string) ($prod->main_image_id ?: ''),
                '', // image_alt
                '', // gallery_links
                $galleryIds,
                'preserve',
            ];

            foreach ($prod->specifications as $spec) {
                $specRows[] = [
                    (string) $prod->sku,
                    (string) $spec->attribute_code,
                    (string) $spec->label,
                    (string) $spec->value,
                    (string) $spec->unit,
                    (string) $spec->sort_order,
                    'upsert',
                ];
            }
        }

        $prevBinder = Cell::getValueBinder();
        Cell::setValueBinder(new StringValueBinder());
        try {
            if (!empty($prodRows)) {
                $sheetProducts->fromArray($prodRows, null, 'A2', false);
            }

            if (!empty($specRows)) {
                $sheetSpecs->fromArray($specRows, null, 'A2', false);
            }
        } finally {
            Cell::setValueBinder($prevBinder);
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
                    'datasheet', 'link_datasheet', 'url_datasheet', 'datasheet_url', 'pdf_datasheet', 'link_pdf', 'datasheet_link', 'pdf' => 'link_datasheet',
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
            $imageUrlVal = null;
            if (!empty($linkGdrive)) {
                if ($linkGdrive === '__CLEAR__') {
                    $imageUrlVal = '__CLEAR__';
                } else {
                    $imageUrlVal = $linkGdrive;
                    if (str_contains($imageUrlVal, 'listrikonline.com/data/product-watermark/')) {
                        $isSe = false;
                        if (!empty($brandId)) {
                            $brandObj = Brand::find($brandId);
                            $isSe = ($brandObj && $brandObj->code === 'SE');
                        } elseif (!empty($rowData['brand_code'])) {
                            $isSe = (strtoupper(trim((string) $rowData['brand_code'])) === 'SE');
                        }
                        $targetExt = $isSe ? '.jpg' : '.webp';
                        $imageUrlVal = preg_replace_callback('#(https?://[^/]+/data/product-watermark/)(.+)$#i', function($m) use ($targetExt) {
                            $filename = strtolower($m[2]);
                            $filename = preg_replace('/\.(webp|jpeg|jpg|png)$/i', $targetExt, $filename);
                            if (!str_ends_with($filename, $targetExt)) {
                                $filename .= $targetExt;
                            }
                            return $m[1] . $filename;
                        }, $imageUrlVal);
                    }
                    if (DriveDownloadAdapter::parseDriveUrl($linkGdrive)) {
                        $dlResult = DriveDownloadAdapter::downloadToStaging($linkGdrive);
                        if ($dlResult['success']) {
                            $stagedMainImagePath = $dlResult['path'];
                        }
                    }
                }
            }

            // Remote Download Staging for Gallery Images (Google Drive or Direct Web URLs separated by ; or ,)
            $stagedGalleryPaths = [];
            $galleryLinks = isset($rowData['gallery_links']) ? trim((string) $rowData['gallery_links']) : '';
            if (!empty($galleryLinks) && $galleryLinks !== '__CLEAR__') {
                $rawUrls = preg_split('/[;,\n\r]+/', $galleryLinks);
                foreach ($rawUrls as $rawUrl) {
                    $u = trim($rawUrl);
                    if (!empty($u) && DriveDownloadAdapter::parseDriveUrl($u)) {
                        $dlResult = DriveDownloadAdapter::downloadToStaging($u);
                        if ($dlResult['success']) {
                            $stagedGalleryPaths[] = $dlResult['path'];
                        }
                    }
                }
            }

            // Remote Datasheet PDF (Direct Web URL or Google Drive link)
            $stagedDatasheetPath = null;
            $linkDatasheet = isset($rowData['link_datasheet']) ? trim((string) $rowData['link_datasheet']) : '';
            $datasheetUrlVal = null;

            if (!empty($linkDatasheet)) {
                if ($linkDatasheet === '__CLEAR__') {
                    $datasheetUrlVal = '__CLEAR__';
                } else {
                    $datasheetUrlVal = $linkDatasheet;
                }
            }

            // Sanitization for description
            $descriptionHtml = isset($rowData['description_html']) ? (string) $rowData['description_html'] : null;
            if ($descriptionHtml !== null && $descriptionHtml !== '__CLEAR__') {
                $descriptionHtml = HtmlSanitizerService::clean($descriptionHtml);
            }

            $units[$normalizedSku] = [
                'row_number' => $row,
                'sku' => $sku,
                'normalized_sku' => $normalizedSku,
                'action' => $existingProduct ? 'update' : 'create',
                'data' => [
                    'sku' => $sku,
                    'normalized_sku' => $normalizedSku,
                    'name' => $nameVal ?: $sku,
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
                    'image_url' => $imageUrlVal,
                    'staged_gallery_paths' => $stagedGalleryPaths,
                    'datasheet_url' => $datasheetUrlVal,
                    'staged_datasheet_path' => $stagedDatasheetPath,
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

            // Map header names dynamically
            $specHeaderMap = [];
            if (!empty($allSpecRows[0])) {
                foreach ($allSpecRows[0] as $colIdx => $headerVal) {
                    $val = strtolower(trim((string) $headerVal));
                    if (!empty($val)) {
                        $specHeaderMap[$val] = $colIdx;
                    }
                }
            }

            for ($j = 1; $j < $totalSpecRows; $j++) {
                $specRowCells = $allSpecRows[$j];
                $rowNum = $j + 1;

                $skuCol = $specHeaderMap['sku'] ?? 0;
                $rawSku = $specRowCells[$skuCol] ?? null;
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

                $attrCodeCol = $specHeaderMap['attribute_code'] ?? 1;
                $attrCode = trim((string) ($specRowCells[$attrCodeCol] ?? ''));
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

                $labelCol = $specHeaderMap['label'] ?? 2;
                $valCol = $specHeaderMap['value'] ?? 3;
                $unitCol = $specHeaderMap['unit'] ?? 4;
                $sortCol = $specHeaderMap['sort_order'] ?? (isset($specHeaderMap['group']) ? 6 : 5);
                $opCol = $specHeaderMap['operation'] ?? (isset($specHeaderMap['group']) ? 7 : 6);

                $units[$normalizedSku]['specifications'][] = [
                    'attribute_code' => $attrCode,
                    'label' => trim((string) ($specRowCells[$labelCol] ?? '')),
                    'value' => trim((string) ($specRowCells[$valCol] ?? '')),
                    'unit' => trim((string) ($specRowCells[$unitCol] ?? '')),
                    'sort_order' => (int) ($specRowCells[$sortCol] ?? 0),
                    'operation' => trim((string) ($specRowCells[$opCol] ?? '')) === 'remove' ? 'remove' : 'upsert',
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

            // Process datasheet document if staged or URL provided
            $datasheetId = null;
            if (!empty($data['staged_datasheet_path']) && file_exists($data['staged_datasheet_path'])) {
                $mediaDoc = MediaService::storeStagedFile($data['staged_datasheet_path'], "datasheet_{$sku}.pdf", $userId);
                $datasheetId = $mediaDoc->id;
            }
            $imageUrl = $data['image_url'] ?? null;
            $datasheetUrl = $data['datasheet_url'] ?? null;

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
                    'image_url' => ($imageUrl && $imageUrl !== '__CLEAR__') ? $imageUrl : null,
                    'datasheet_id' => $datasheetId,
                    'datasheet_url' => ($datasheetUrl && $datasheetUrl !== '__CLEAR__') ? $datasheetUrl : null,
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
                if (array_key_exists('image_url', $data) && $data['image_url'] !== null) {
                    $updates['image_url'] = ($data['image_url'] === '__CLEAR__') ? null : $data['image_url'];
                }
                if ($datasheetId !== null) $updates['datasheet_id'] = $datasheetId;
                if (array_key_exists('datasheet_url', $data) && $data['datasheet_url'] !== null) {
                    if ($data['datasheet_url'] === '__CLEAR__') {
                        $updates['datasheet_url'] = null;
                        $updates['datasheet_id'] = null;
                    } else {
                        $updates['datasheet_url'] = $data['datasheet_url'];
                    }
                }
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
                                'group' => null,
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
