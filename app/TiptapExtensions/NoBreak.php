<?php

namespace App\TiptapExtensions;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;
use Tiptap\Utils\InlineStyle;

class NoBreak extends Mark
{
    public static $name = 'no-break';

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'span',
            ],
        ];
    }

    public function addAttributes()
    {
        return [
            'color' => [
                'parseHTML' => function ($DOMNode) {
                    return InlineStyle::getAttribute($DOMNode, 'word-break') ?: null;
                },
                'renderHTML' => function ($attributes) {
                    return [
                        'style' => "word-break: keep-all",
                    ];
                },
            ],
        ];
    }

    public function renderHTML($mark, $HTMLAttributes = [])
    {
        return [
            'span',
            HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes),
            0,
        ];
    }
}
