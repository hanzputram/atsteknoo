<?php

namespace App\Support;

class TextSanitizer
{
    /**
     * Clean plain text description for meta tags and JSON-LD schema,
     * safely stripping real HTML tags while preserving technical symbols
     * such as '<', '>', '&', '×', '±', and comparison/threshold expressions (e.g. '<6 kA', '<6KA', '<= 24V').
     */
    public static function cleanDescription(?string $text): string
    {
        if ($text === null || $text === '') {
            return '';
        }

        // 1. Convert block breaks to spaces so words don't concatenate
        $formatted = preg_replace('/<\s*(?:br\b[^>]*|\/(?:p|div|li|h[1-6]|tr|table))>/i', ' ', $text);

        // 2. Protect '<' that are NOT the start of valid HTML tags
        // In standard HTML, valid tag names start with an ASCII letter or a closing slash followed by a letter.
        // Symbols like '<6', '< 6', '<=', '<>', '<DOM' (when not a tag) are preserved.
        $protected = preg_replace('/<(?![a-zA-Z\/])/i', '[[ATS_LT]]', $formatted);

        // 3. Strip actual HTML tags
        $stripped = strip_tags($protected);

        // 4. Restore the preserved '<' symbols
        $restored = str_replace('[[ATS_LT]]', '<', $stripped);

        // 5. Decode HTML entities (&amp;, &lt;, &gt;, &quot;, &#39;, &times;, etc.)
        $decoded = html_entity_decode($restored, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // 6. Normalize whitespace
        return trim(preg_replace('/\s+/', ' ', $decoded));
    }
}
