<?php

namespace App\Services;

class ChatFormatter
{
    /**
     * Convert markdown (bullets, bold, URLs) safely into clean HTML.
     */
    public static function format(?string $text): string
    {
        if (empty($text)) {
            return '';
        }

        // Clean internal system tokens if any
        $cleaned = trim(str_replace(['[NEEDS_ADMIN]', '[BUTUH_ADMIN]'], '', $text));

        // Escape HTML for XSS safety first
        $escaped = htmlspecialchars($cleaned, ENT_QUOTES, 'UTF-8');

        // 1. Convert bullet points at start of line or string: "* " or "- " -> "• "
        $escaped = preg_replace('/(^|[\r\n]+|<br\s*\/?>)[ \t]*[*\-][ \t]+/', '$1• ', $escaped);

        // 2. Convert Triple asterisks: ***text*** -> <strong><em>$1</em></strong>
        $escaped = preg_replace('/\*\*\*(.+?)\*\*\*/s', '<strong><em>$1</em></strong>', $escaped);

        // 3. Convert Bold markdown: **text** -> <strong>$1</strong>
        $escaped = preg_replace('/\*\*\s*([^\*]+?)\s*\*\*/s', '<strong>$1</strong>', $escaped);

        // 4. Convert Single asterisk (WhatsApp-style bold): *text* -> <strong>$2</strong>
        $escaped = preg_replace('/(^|[^\*])\*\s*([^\s\*](?:.*?[^\s\*])?)\s*\*(?!\*)/s', '$1<strong>$2</strong>', $escaped);

        // 3. Linkify URLs
        $urlPattern = '/(https?:\/\/[^\s<]+)/';
        $escaped = preg_replace(
            $urlPattern,
            '<a href="$1" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: underline; font-weight: 700;">$1</a>',
            $escaped
        );

        return $escaped;
    }
}
