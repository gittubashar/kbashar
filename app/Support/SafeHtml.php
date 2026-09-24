<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;

class SafeHtml
{
    private const ALLOWED_TAGS = '<p><br><h2><h3><h4><ul><ol><li><strong><em><a><blockquote>';

    public static function clean(?string $html): string
    {
        $html = strip_tags($html ?? '', self::ALLOWED_TAGS);

        if ($html === '') {
            return '';
        }

        $document = new DOMDocument('1.0', 'UTF-8');
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML(
            '<?xml encoding="UTF-8"><div id="safe-html-root">'.$html.'</div>',
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        foreach ($document->getElementsByTagName('*') as $element) {
            if (! $element instanceof DOMElement) {
                continue;
            }

            foreach (iterator_to_array($element->attributes) as $attribute) {
                if ($element->tagName !== 'a' || ! in_array($attribute->name, ['href', 'title'], true)) {
                    $element->removeAttribute($attribute->name);
                }
            }

            if ($element->tagName === 'a') {
                $href = trim($element->getAttribute('href'));
                if ($href !== '' && ! preg_match('~^(https?://|mailto:|tel:|/|#)~i', $href)) {
                    $element->removeAttribute('href');
                }
                $element->setAttribute('rel', 'noopener noreferrer');
            }
        }

        $root = $document->getElementById('safe-html-root');
        if (! $root) {
            return '';
        }

        return collect(iterator_to_array($root->childNodes))
            ->map(fn (DOMNode $node): string => $document->saveHTML($node))
            ->implode('');
    }
}
