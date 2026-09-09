<?php

namespace App\Services;

use DOMDocument;
use DOMElement;
use DOMNode;
use DOMXPath;

class HtmlSanitizerService
{
    /**
     * Allowed HTML elements.
     */
    protected static array $allowedTags = [
        'h2', 'h3', 'h4', 'h5', 'h6',
        'p', 'br', 'hr',
        'strong', 'b', 'em', 'i', 'u', 's', 'strike', 'sub', 'sup',
        'ul', 'ol', 'li',
        'blockquote', 'pre', 'code',
        'table', 'thead', 'tbody', 'tfoot', 'tr', 'th', 'td',
        'a', 'img', 'figure', 'figcaption',
        'div', 'span',
    ];

    /**
     * Allowed attributes per element.
     */
    protected static array $allowedAttributes = [
        '*' => ['title', 'class', 'id', 'dir', 'lang'],
        'a' => ['href', 'target', 'rel'],
        'img' => ['src', 'alt', 'width', 'height', 'loading'],
        'th' => ['colspan', 'rowspan', 'scope'],
        'td' => ['colspan', 'rowspan'],
        'ol' => ['start', 'type'],
    ];

    /**
     * Allowed URI schemes.
     */
    protected static array $allowedSchemes = [
        'http', 'https', 'mailto', 'tel',
    ];

    /**
     * Sanitize the given HTML string.
     */
    public static function clean(?string $html): string
    {
        if (empty($html)) {
            return '';
        }

        // Pre-strip script, style, and object/iframe tags before DOM parsing
        $html = preg_replace('/<(script|style|iframe|object|embed|applet)[\s\S]*?<\/\1>/i', '', $html);
        $html = preg_replace('/<script[\s\S]*?>/i', '', $html);

        $doc = new DOMDocument();
        $previousEntityLoader = libxml_use_internal_errors(true);

        // UTF-8 encoding wrapper
        $wrapped = '<?xml encoding="utf-8" ?><div>' . $html . '</div>';
        $doc->loadHTML($wrapped, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        libxml_use_internal_errors($previousEntityLoader);

        $root = $doc->getElementsByTagName('div')->item(0);
        if (!$root) {
            return '';
        }

        static::sanitizeNode($root);

        // Extract inner HTML of wrapper div
        $output = '';
        foreach ($root->childNodes as $child) {
            $output .= $doc->saveHTML($child);
        }

        return trim($output);
    }

    /**
     * Recursively sanitize DOM nodes.
     */
    protected static function sanitizeNode(DOMNode $node): void
    {
        $children = [];
        foreach ($node->childNodes as $child) {
            $children[] = $child;
        }

        foreach ($children as $child) {
            if ($child instanceof DOMElement) {
                $tagName = strtolower($child->nodeName);

                if (!in_array($tagName, static::$allowedTags, true)) {
                    // Replace disallowed tag with its text/children
                    while ($child->hasChildNodes()) {
                        $node->insertBefore($child->firstChild, $child);
                    }
                    $node->removeChild($child);
                    continue;
                }

                // Sanitize element attributes
                if ($child->hasAttributes()) {
                    $attributesToRemove = [];
                    foreach ($child->attributes as $attr) {
                        $attrName = strtolower($attr->name);

                        // Strip any event handlers (e.g. onclick, onerror, onload)
                        if (str_starts_with($attrName, 'on')) {
                            $attributesToRemove[] = $attr->name;
                            continue;
                        }

                        $allowedForTag = static::$allowedAttributes[$tagName] ?? [];
                        $allowedGlobal = static::$allowedAttributes['*'] ?? [];

                        if (!in_array($attrName, $allowedForTag, true) && !in_array($attrName, $allowedGlobal, true)) {
                            $attributesToRemove[] = $attr->name;
                            continue;
                        }

                        // Validate URI attributes
                        if (in_array($attrName, ['href', 'src'], true)) {
                            $value = trim($attr->value);
                            if (!static::isSafeUri($value)) {
                                $attributesToRemove[] = $attr->name;
                                continue;
                            }

                            // If link opens in new tab, ensure rel="noopener noreferrer"
                            if ($tagName === 'a' && $child->getAttribute('target') === '_blank') {
                                $child->setAttribute('rel', 'noopener noreferrer');
                            }
                        }
                    }

                    foreach ($attributesToRemove as $attrName) {
                        $child->removeAttribute($attrName);
                    }
                }

                static::sanitizeNode($child);
            }
        }
    }

    /**
     * Check if a URL has an allowed scheme and no dangerous payloads.
     */
    public static function isSafeUri(string $uri): bool
    {
        $uri = trim($uri);

        // Disallow dangerous URI wrappers
        if (preg_match('/^(javascript|vbscript|data):/i', $uri)) {
            return false;
        }

        // Relative path or hash anchor
        if (str_starts_with($uri, '/') || str_starts_with($uri, '#') || str_starts_with($uri, './')) {
            return true;
        }

        $scheme = parse_url($uri, PHP_URL_SCHEME);
        if (!$scheme) {
            return true;
        }

        return in_array(strtolower($scheme), static::$allowedSchemes, true);
    }
}
