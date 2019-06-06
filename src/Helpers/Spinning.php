<?php

namespace Generator\Helpers;

class Spinning
{
    /**
     * @param string $text
     *
     * @return string
     */
    public static function process($text)
    {
        return preg_replace_callback(
            '/\{(((?>[^\{\}]+)|(?R))*)\}/x',
            ['\Generator\Helpers\Spinning', 'replace'],
            $text
        );
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public static function replace($text)
    {
        $text = self::process($text[1]);
        $parts = explode('|', $text);

        return $parts[array_rand($parts)];
    }
}
