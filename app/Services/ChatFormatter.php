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

        // 5. Convert Markdown links: [label](url) -> <a href="cleanUrl">label</a>
        $escaped = preg_replace_callback(
            '/\[([^\]]+)\]\((https?:\/\/[^\s\)<>]+)\)/',
            function ($matches) {
                $label = $matches[1];
                $url = rtrim($matches[2], '.,;:!?)');
                return '<a href="' . $url . '" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: underline; font-weight: 700;">' . $label . '</a>';
            },
            $escaped
        );

        // 6. Linkify remaining bare URLs (without swallowing trailing punctuation like . , ! ? ) ] )
        $escaped = preg_replace_callback(
            '/(^|[^"\'=])(https?:\/\/[^\s<"\'<>]+)/',
            function ($matches) {
                $prefix = $matches[1];
                $rawUrl = $matches[2];
                $trailing = '';
                if (preg_match('/[.,;:!?\)\]]+$/', $rawUrl, $pMatches)) {
                    $trailing = $pMatches[0];
                    $rawUrl = substr($rawUrl, 0, -strlen($trailing));
                }
                return $prefix . '<a href="' . $rawUrl . '" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: underline; font-weight: 700;">' . $rawUrl . '</a>' . $trailing;
            },
            $escaped
        );

        return $escaped;
    }
}
