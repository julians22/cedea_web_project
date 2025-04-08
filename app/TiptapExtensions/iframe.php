<?php

namespace App\TiptapExtensions;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;
use Tiptap\Utils\InlineStyle;

class Iframe extends Node
{
    public static $name = 'iframe';

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [
                'class' => "iframe-wrapper"
            ],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'iframe',
            ],
        ];
    }

    public function addAttributes()
    {
        return [
            'src' => [
                'default' => null,
            ],
        ];
    }

    public function renderHTML($HTMLAttributes = [])
    {

        return [
            'div',
            $this->options['HTMLAttributes'],
            ['iframe', $HTMLAttributes]
        ];
    }
}
