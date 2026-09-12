<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DriveDownloadAdapter
{
    /**
     * Allowed Google Drive domains.
     */
    protected static array $allowedHosts = [
        'drive.google.com',
        'docs.google.com',
        'drive.usercontent.google.com',
        'googleusercontent.com',
    ];

    /**
     * Max download size: 10 MiB (10 * 1024 * 1024 bytes)
     */
    protected const MAX_BYTES = 10485760;

    /**
     * Connect timeout: 10s, request timeout: 60s
     */
    protected const CONNECT_TIMEOUT = 5;
    protected const TIMEOUT = 15;

    /**
     * Parse and extract File ID and query parameters from Google Drive share link.
     */
    public static function parseDriveUrl(string $url): ?array
    {
        $url = trim($url);
        $parsed = parse_url($url);

        if (!$parsed || empty($parsed['host'])) {
            return null;
        }

        $host = strtolower($parsed['host']);
        if (!in_array($host, ['drive.google.com', 'docs.google.com'], true)) {
            return null;
        }

        $path = $parsed['path'] ?? '';
        $query = [];
        if (!empty($parsed['query'])) {
            parse_str($parsed['query'], $query);
        }

        $fileId = null;

        // Pattern 1: /file/d/{FILE_ID}/view or /file/d/{FILE_ID}
        if (preg_match('#/file/d/([a-zA-Z0-9_-]+)#', $path, $matches)) {
            $fileId = $matches[1];
        }
        // Pattern 2: ?id={FILE_ID}
        elseif (!empty($query['id'])) {
            $fileId = $query['id'];
        }

        if (!$fileId) {
            return null;
        }

        return [
            'file_id' => $fileId,
            'resourcekey' => $query['resourcekey'] ?? null,
        ];
    }

    /**
     * Download Google Drive image to a local private staging path.
     *
     * @return array [success => bool, path => string|null, error_code => string|null, error_message => string|null, mime => string|null, size => int|null]
     */
    public static function downloadToStaging(string $url, ?string $targetDir = null): array
    {
        $url = trim($url);
        $driveInfo = static::parseDriveUrl($url);
        $isDrive = !empty($driveInfo);

        if ($isDrive) {
            $fileId = $driveInfo['file_id'];
            $resourceKey = $driveInfo['resourcekey'];
            $downloadUrl = "https://drive.google.com/uc?export=download&id={$fileId}";
            if ($resourceKey) {
                $downloadUrl .= "&resourcekey={$resourceKey}";
            }
            $stagedFileName = 'gdrive_' . $fileId . '_' . Str::random(12) . '.tmp';
        } else {
            // Direct Web Image URL (e.g. https://listrikonline.com/data/product-watermark/se-dom12523-1.jpg)
            if (!filter_var($url, FILTER_VALIDATE_URL) || !preg_match('#^https?://#i', $url)) {
                return [
                    'success' => false,
                    'error_code' => 'INVALID_IMAGE_URL',
                    'error_message' => 'Format URL tidak valid. Masukkan tautan Google Drive atau URL web gambar langsung (https://...).',
                ];
            }
            $downloadUrl = $url;
            $hash = substr(md5($url), 0, 12);
            $stagedFileName = 'webimg_' . $hash . '_' . Str::random(8) . '.tmp';
            $fileId = $hash;
        }

        if (!$targetDir) {
            $targetDir = storage_path('app/private/staging');
        }

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $stagedPath = $targetDir . DIRECTORY_SEPARATOR . $stagedFileName;

        try {
            // SSRF validation for the download URL
            $urlCheck = static::validateUrlSecurity($downloadUrl);
            if (!$urlCheck['safe']) {
                return [
                    'success' => false,
                    'error_code' => 'BLOCKED_REMOTE_TARGET',
                    'error_message' => 'Target URL diblokir oleh kebijakan keamanan jaringan: ' . $urlCheck['reason'],
                ];
            }

            // Stream download using Guzzle / stream context with redirect hop checking
            $fp = fopen($stagedPath, 'w+b');
            if (!$fp) {
                return [
                    'success' => false,
                    'error_code' => 'IMAGE_STORAGE_FAILED',
                    'error_message' => 'Gagal membuka file staging lokal untuk penyimpanan sementara.',
                ];
            }

            $currentUrl = $downloadUrl;
            $redirectCount = 0;
            $maxRedirects = 3;
            $downloadSuccess = false;
            $httpStatusCode = 200;

            while ($redirectCount <= $maxRedirects) {
                $ch = curl_init($currentUrl);
                // If curl is not available, use stream wrapper
                if (!$ch) {
                    fclose($fp);
                    return static::downloadViaStreamWrapper($currentUrl, $stagedPath);
                }

                curl_setopt_array($ch, [
                    CURLOPT_FILE => $fp,
                    CURLOPT_HEADER => false,
                    CURLOPT_FOLLOWLOCATION => false,
                    CURLOPT_CONNECTTIMEOUT => static::CONNECT_TIMEOUT,
                    CURLOPT_TIMEOUT => static::TIMEOUT,
                    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 ATS-Tekno/1.0',
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => 0,
                ]);

                $execResult = curl_exec($ch);
                $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $redirectUrl = curl_getinfo($ch, CURLINFO_REDIRECT_URL);
                $curlError = curl_error($ch);
                $curlErrno = curl_errno($ch);
                curl_close($ch);

                if (!$execResult && $curlErrno === CURLE_OPERATION_TIMEDOUT) {
                    fclose($fp);
                    @unlink($stagedPath);
                    return [
                        'success' => false,
                        'error_code' => 'IMAGE_DOWNLOAD_TIMEOUT',
                        'error_message' => 'Koneksi ke server gambar melewati batas waktu (timeout).',
                    ];
                }

                // Handle Redirects
                if (in_array($httpStatusCode, [301, 302, 303, 307, 308]) && !empty($redirectUrl)) {
                    $sec = static::validateUrlSecurity($redirectUrl);
                    if (!$sec['safe']) {
                        fclose($fp);
                        @unlink($stagedPath);
                        return [
                            'success' => false,
                            'error_code' => 'BLOCKED_REMOTE_TARGET',
                            'error_message' => 'Redirect ke host tidak diizinkan: ' . $sec['reason'],
                        ];
                    }

                    // Reset file pointer for redirect target
                    ftruncate($fp, 0);
                    rewind($fp);
                    $currentUrl = $redirectUrl;
                    $redirectCount++;
                    continue;
                }

                $downloadSuccess = ($httpStatusCode >= 200 && $httpStatusCode < 300);
                break;
            }

            fclose($fp);

            if (!$downloadSuccess) {
                @unlink($stagedPath);

                if ($httpStatusCode === 404) {
                    return [
                        'success' => false,
                        'error_code' => $isDrive ? 'DRIVE_FILE_NOT_FOUND' : 'IMAGE_NOT_FOUND',
                        'error_message' => $isDrive
                            ? 'File Google Drive tidak ditemukan (HTTP 404). Periksa kembali File ID.'
                            : 'Gambar tidak ditemukan pada URL target (HTTP 404). Periksa kembali tautan gambar.',
                    ];
                }
                if ($httpStatusCode === 403) {
                    return [
                        'success' => false,
                        'error_code' => $isDrive ? 'DRIVE_ACCESS_DENIED' : 'IMAGE_ACCESS_DENIED',
                        'error_message' => $isDrive
                            ? 'Akses ke file Google Drive ditolak (HTTP 403). Pastikan sharing disetel ke "Siapa saja yang memiliki tautan".'
                            : 'Akses ke URL gambar ditolak oleh server sumber (HTTP 403). Pastikan tautan dapat diakses publik.',
                    ];
                }
                if ($httpStatusCode === 429) {
                    return [
                        'success' => false,
                        'error_code' => 'IMAGE_RATE_LIMITED',
                        'error_message' => 'Batas permintaan (rate limit) server gambar tercapai (HTTP 429). Coba beberapa saat lagi.',
                    ];
                }

                return [
                    'success' => false,
                    'error_code' => 'IMAGE_DOWNLOAD_FAILED',
                    'error_message' => "Gagal mengunduh gambar (HTTP status {$httpStatusCode}).",
                ];
            }

            // Validate downloaded content
            $fileSize = filesize($stagedPath);
            if ($fileSize > static::MAX_BYTES) {
                @unlink($stagedPath);
                return [
                    'success' => false,
                    'error_code' => 'IMAGE_TOO_LARGE',
                    'error_message' => 'Ukuran file gambar melebihi batas 10 MiB (' . round($fileSize / 1048576, 2) . ' MiB).',
                ];
            }

            // Check if file is HTML (e.g. Google Drive virus scan warning / login page)
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $stagedPath);
            finfo_close($finfo);

            if (str_contains($mimeType, 'html') || str_contains($mimeType, 'text') || str_contains($mimeType, 'json')) {
                // Check if it's a confirmation page
                $contentSample = file_get_contents($stagedPath, false, null, 0, 1000);
                @unlink($stagedPath);

                if (str_contains($contentSample, 'Google Drive - Virus scan warning') || str_contains($contentSample, 'confirm=')) {
                    return [
                        'success' => false,
                        'error_code' => 'DRIVE_DOWNLOAD_RESTRICTED',
                        'error_message' => 'File memerlukan konfirmasi download interaktif dari Google Drive yang tidak didukung.',
                    ];
                }

                return [
                    'success' => false,
                    'error_code' => 'INVALID_IMAGE_CONTENT',
                    'error_message' => 'Hasil download bukan file gambar valid (MIME: ' . $mimeType . ').',
                ];
            }

            // Verify with getimagesize
            $imageInfo = @getimagesize($stagedPath);
            if (!$imageInfo) {
                @unlink($stagedPath);
                return [
                    'success' => false,
                    'error_code' => 'INVALID_IMAGE_CONTENT',
                    'error_message' => 'Berkas terunduh rusak atau bukan format gambar raster yang didukung (JPEG, PNG, WEBP).',
                ];
            }

            return [
                'success' => true,
                'path' => $stagedPath,
                'file_id' => $fileId,
                'mime' => $imageInfo['mime'],
                'width' => $imageInfo[0],
                'height' => $imageInfo[1],
                'size' => $fileSize,
            ];

        } catch (Exception $e) {
            @unlink($stagedPath);
            return [
                'success' => false,
                'error_code' => 'IMAGE_STORAGE_FAILED',
                'error_message' => 'Terjadi kesalahan sistem saat mengunduh gambar: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Download Google Drive or web PDF document to a local private staging path.
     *
     * @return array [success => bool, path => string|null, error_code => string|null, error_message => string|null, mime => string|null, size => int|null]
     */
    public static function downloadPdfToStaging(string $url, ?string $targetDir = null): array
    {
        $url = trim($url);
        $driveInfo = static::parseDriveUrl($url);
        $isDrive = !empty($driveInfo);

        if ($isDrive) {
            $fileId = $driveInfo['file_id'];
            $resourceKey = $driveInfo['resourcekey'];
            $downloadUrl = "https://drive.google.com/uc?export=download&id={$fileId}";
            if ($resourceKey) {
                $downloadUrl .= "&resourcekey={$resourceKey}";
            }
            $stagedFileName = 'gdrive_pdf_' . $fileId . '_' . Str::random(12) . '.pdf';
        } else {
            if (!filter_var($url, FILTER_VALIDATE_URL) || !preg_match('#^https?://#i', $url)) {
                return [
                    'success' => false,
                    'error_code' => 'INVALID_PDF_URL',
                    'error_message' => 'Format URL tidak valid. Masukkan tautan Google Drive atau URL web PDF langsung (https://...).',
                ];
            }
            $downloadUrl = $url;
            $hash = substr(md5($url), 0, 12);
            $stagedFileName = 'webpdf_' . $hash . '_' . Str::random(8) . '.pdf';
            $fileId = $hash;
        }

        if (!$targetDir) {
            $targetDir = storage_path('app/private/staging');
        }

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $stagedPath = $targetDir . DIRECTORY_SEPARATOR . $stagedFileName;

        try {
            $urlCheck = static::validateUrlSecurity($downloadUrl);
            if (!$urlCheck['safe']) {
                return [
                    'success' => false,
                    'error_code' => 'BLOCKED_REMOTE_TARGET',
                    'error_message' => 'Target URL diblokir oleh kebijakan keamanan jaringan: ' . $urlCheck['reason'],
                ];
            }

            $fp = fopen($stagedPath, 'w+b');
            if (!$fp) {
                return [
                    'success' => false,
                    'error_code' => 'FILE_STORAGE_FAILED',
                    'error_message' => 'Gagal membuka file staging lokal untuk dokumen PDF.',
                ];
            }

            $currentUrl = $downloadUrl;
            $redirectCount = 0;
            $maxRedirects = 3;
            $downloadSuccess = false;
            $httpStatusCode = 200;

            while ($redirectCount <= $maxRedirects) {
                $ch = curl_init($currentUrl);
                if (!$ch) {
                    fclose($fp);
                    return static::downloadViaStreamWrapper($currentUrl, $stagedPath);
                }

                curl_setopt_array($ch, [
                    CURLOPT_FILE => $fp,
                    CURLOPT_HEADER => false,
                    CURLOPT_FOLLOWLOCATION => false,
                    CURLOPT_CONNECTTIMEOUT => static::CONNECT_TIMEOUT,
                    CURLOPT_TIMEOUT => static::TIMEOUT,
                    CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 ATS-Tekno/1.0',
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => 0,
                ]);

                $execResult = curl_exec($ch);
                $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                $redirectUrl = curl_getinfo($ch, CURLINFO_REDIRECT_URL);
                $curlErrno = curl_errno($ch);
                curl_close($ch);

                if (!$execResult && $curlErrno === CURLE_OPERATION_TIMEDOUT) {
                    fclose($fp);
                    @unlink($stagedPath);
                    return [
                        'success' => false,
                        'error_code' => 'PDF_DOWNLOAD_TIMEOUT',
                        'error_message' => 'Koneksi ke server dokumen PDF melewati batas waktu (timeout).',
                    ];
                }

                if (in_array($httpStatusCode, [301, 302, 303, 307, 308]) && !empty($redirectUrl)) {
                    $sec = static::validateUrlSecurity($redirectUrl);
                    if (!$sec['safe']) {
                        fclose($fp);
                        @unlink($stagedPath);
                        return [
                            'success' => false,
                            'error_code' => 'BLOCKED_REMOTE_TARGET',
                            'error_message' => 'Redirect ke host tidak diizinkan: ' . $sec['reason'],
                        ];
                    }
                    ftruncate($fp, 0);
                    rewind($fp);
                    $currentUrl = $redirectUrl;
                    $redirectCount++;
                    continue;
                }

                $downloadSuccess = ($httpStatusCode >= 200 && $httpStatusCode < 300);
                break;
            }

            fclose($fp);

            if (!$downloadSuccess) {
                @unlink($stagedPath);
                return [
                    'success' => false,
                    'error_code' => 'PDF_DOWNLOAD_FAILED',
                    'error_message' => "Gagal mengunduh berkas PDF (HTTP status {$httpStatusCode}).",
                ];
            }

            $fileSize = filesize($stagedPath);
            $maxPdfBytes = 20971520; // 20 MiB
            if ($fileSize > $maxPdfBytes) {
                @unlink($stagedPath);
                return [
                    'success' => false,
                    'error_code' => 'PDF_TOO_LARGE',
                    'error_message' => 'Ukuran file PDF melebihi batas 20 MiB (' . round($fileSize / 1048576, 2) . ' MiB).',
                ];
            }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $stagedPath);
            finfo_close($finfo);

            $headBytes = file_get_contents($stagedPath, false, null, 0, 10);
            $isPdf = str_contains($mimeType, 'pdf') || str_starts_with($headBytes ?: '', '%PDF-');

            if (!$isPdf) {
                @unlink($stagedPath);
                return [
                    'success' => false,
                    'error_code' => 'INVALID_PDF_CONTENT',
                    'error_message' => 'Hasil download bukan berkas PDF valid (MIME: ' . $mimeType . ').',
                ];
            }

            return [
                'success' => true,
                'path' => $stagedPath,
                'file_id' => $fileId,
                'mime' => 'application/pdf',
                'size' => $fileSize,
            ];
        } catch (Exception $e) {
            @unlink($stagedPath);
            return [
                'success' => false,
                'error_code' => 'PDF_STORAGE_FAILED',
                'error_message' => 'Terjadi kesalahan sistem saat mengunduh PDF: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Fallback download via stream wrapper when curl extension is absent.
     */
    protected static function downloadViaStreamWrapper(string $url, string $stagedPath): array
    {
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'timeout' => static::TIMEOUT,
                'follow_location' => 1,
                'max_redirects' => 3,
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 ATS-Tekno/1.0',
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);

        $in = @fopen($url, 'rb', false, $context);
        if (!$in) {
            @unlink($stagedPath);
            return [
                'success' => false,
                'error_code' => 'IMAGE_ACCESS_DENIED',
                'error_message' => 'Gagal membuka stream file gambar. Pastikan tautan dapat diakses publik.',
            ];
        }

        $out = fopen($stagedPath, 'wb');
        $bytesWritten = stream_copy_to_stream($in, $out, static::MAX_BYTES + 1024);
        fclose($in);
        fclose($out);

        if ($bytesWritten > static::MAX_BYTES) {
            @unlink($stagedPath);
            return [
                'success' => false,
                'error_code' => 'IMAGE_TOO_LARGE',
                'error_message' => 'Ukuran gambar melebihi batas 10 MiB.',
            ];
        }

        $imageInfo = @getimagesize($stagedPath);
        if (!$imageInfo) {
            @unlink($stagedPath);
            return [
                'success' => false,
                'error_code' => 'INVALID_IMAGE_CONTENT',
                'error_message' => 'Response stream bukan format gambar raster yang valid.',
            ];
        }

        return [
            'success' => true,
            'path' => $stagedPath,
            'mime' => $imageInfo['mime'],
            'width' => $imageInfo[0],
            'height' => $imageInfo[1],
            'size' => filesize($stagedPath),
        ];
    }

    /**
     * Check if a URL is safe to download from (convenience wrapper).
     */
    public static function isUrlSafe(string $url): bool
    {
        return static::validateUrlSecurity($url)['safe'];
    }

    /**
     * Validate URL security and prevent SSRF attacks.
     */
    public static function validateUrlSecurity(string $url): array
    {
        $parsed = parse_url($url);
        if (!$parsed || empty($parsed['host']) || empty($parsed['scheme'])) {
            return ['safe' => false, 'reason' => 'Format URL tidak valid'];
        }

        $scheme = strtolower($parsed['scheme']);
        if (!in_array($scheme, ['http', 'https'], true)) {
            return ['safe' => false, 'reason' => 'Hanya skema HTTP dan HTTPS yang diizinkan'];
        }

        $host = strtolower($parsed['host']);

        // Block localhost and internal/private hostnames
        if (in_array($host, ['localhost', '127.0.0.1', '::1', '0.0.0.0'], true)
            || str_ends_with($host, '.local')
            || str_ends_with($host, '.internal')
            || str_ends_with($host, '.test')
            || str_ends_with($host, '.onion')) {
            return ['safe' => false, 'reason' => "Host '{$host}' adalah alamat lokal/privat yang diblokir demi keamanan"];
        }

        // DNS resolution check: IP must not be private, loopback, or metadata
        $ips = @dns_get_record($host, DNS_A + DNS_AAAA);
        if ($ips) {
            foreach ($ips as $record) {
                $ip = $record['ip'] ?? $record['ipv6'] ?? null;
                if ($ip && static::isPrivateOrReservedIp($ip)) {
                    return ['safe' => false, 'reason' => "Target IP {$ip} adalah alamat privat / loopback"];
                }
            }
        }

        return ['safe' => true, 'reason' => 'OK'];
    }

    /**
     * Check if an IP address belongs to loopback, private, link-local, or cloud metadata ranges.
     */
    public static function isPrivateOrReservedIp(string $ip): bool
    {
        // Check loopback
        if ($ip === '127.0.0.1' || $ip === '::1' || str_starts_with($ip, '127.')) {
            return true;
        }

        // Check AWS/GCP cloud metadata IP
        if ($ip === '169.254.169.254' || str_starts_with($ip, '169.254.')) {
            return true;
        }

        // Validate via filter_var
        if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return true;
        }

        return false;
    }
}
