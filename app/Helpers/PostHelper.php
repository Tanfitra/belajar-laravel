<?php

namespace App\Helpers;

class PostHelper
{
    public static function extractFirstImage($content)
    {
        
        preg_match('/<img[^>]+src="([^">]+)"/', $content, $matches);

        if (isset($matches[1])) {
            $imageUrl = $matches[1];

            $parsedUrl = parse_url($imageUrl);
            $path = $parsedUrl['path'] ?? '';
            $filename = basename($path);

            return $filename;
        }

        return null;
    }
}