<?php

use Illuminate\Support\Str;

if (!function_exists('excerpt_text')) {
    function excerpt_text(string $text) {
        $strip_text = strip_tags($text);

        return Str::limit($strip_text, 120, '(...)');
    }
}


?>
