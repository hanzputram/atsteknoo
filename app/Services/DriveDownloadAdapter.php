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
    protected const CONNECT_TIMEOUT = 10;
    protected const TIMEOUT = 60;

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
        $parsed = static::parseDriveUrl($url);
        if (!$parsed) {
            return [
                'success' => false,
                'error_code' => 'INVALID_DRIVE_URL',
                'error_message' => 'Format URL Google Drive tidak dikenali. Gunakan tautan file gambar yang valid.',
            ];
        }

        $fileId = $parsed['file_id'];
        $resourceKey = $parsed['resourcekey'];

        // Direct export download URL
        $downloadUrl = "https://drive.google.com/uc?export=download&id={$fileId}";
        if ($resourceKey) {
            $downloadUrl .= "&resourcekey={$resourceKey}";
        }

        if (!$targetDir) {
            $targetDir = storage_path('app/private/staging');
        }

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $stagedFileName = 'gdrive_' . $fileId . '_' . Str::random(12) . '.tmp';
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
                    CURLOPT_USERAGENT => 'ATS-Tekno-DriveAdapter/1.0',
                    CURLOPT_SSL_VERIFYPEER => true,
                    CURLOPT_SSL_VERIFYHOST => 2,
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
                        'error_message' => 'Koneksi ke Google Drive melewati batas waktu (timeout).',
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
                        'error_code' => 'DRIVE_FILE_NOT_FOUND',
                        'error_message' => 'File Google Drive tidak ditemukan (HTTP 404). Periksa kembali File ID.',
                    ];
                }
                if ($httpStatusCode === 403) {
                    return [
                        'success' => false,
                        'error_code' => 'DRIVE_ACCESS_DENIED',
                        'error_message' => 'Akses ke file ditolak (HTTP 403). Pastikan sharing disetel ke "Siapa saja yang memiliki tautan".',
                    ];
                }
                if ($httpStatusCode === 429) {
                    return [
                        'success' => false,
                        'error_code' => 'DRIVE_RATE_LIMITED',
                        'error_message' => 'Quota atau rate limit Google Drive tercapai (HTTP 429). Coba beberapa saat lagi.',
                    ];
                }

                return [
                    'success' => false,
                    'error_code' => 'DRIVE_DOWNLOAD_RESTRICTED',
                    'error_message' => "Gagal mengunduh file Google Drive (HTTP status {$httpStatusCode}).",
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
                'user_agent' => 'ATS-Tekno-DriveAdapter/1.0',
            ],
            'ssl' => [
                'verify_peer' => true,
                'verify_peer_name' => true,
            ],
        ]);

        $in = @fopen($url, 'rb', false, $context);
        if (!$in) {
            @unlink($stagedPath);
            return [
                'success' => false,
                'error_code' => 'DRIVE_ACCESS_DENIED',
                'error_message' => 'Gagal membuka stream file Google Drive. Pastikan file dapat diakses publik.',
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
        if ($scheme !== 'https') {
            return ['safe' => false, 'reason' => 'Hanya skema HTTPS yang diizinkan'];
        }

        $host = strtolower($parsed['host']);

        // Check if host ends with or is in allowed Google domains
        $isAllowedHost = false;
        foreach (static::$allowedHosts as $allowed) {
            if ($host === $allowed || str_ends_with($host, '.' . $allowed)) {
                $isAllowedHost = true;
                break;
            }
        }

        if (!$isAllowedHost) {
            return ['safe' => false, 'reason' => "Host '{$host}' di luar domain Google Drive resmi"];
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
