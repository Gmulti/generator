<?php

namespace Generator\Helpers;

abstract class Tokens
{
    const T_FOREACH = 'T_FOREACH';
    const T_FOREACH_REGEX = '\[% for(?:.*)\[% endfor %\]';

    /**
     * @return array
     */
    public static function getTokens()
    {
        return [
            self::T_FOREACH => self::T_FOREACH_REGEX,
            'T_DNUMBER' => '\d+',
            'T_WHITESPACE' => '\s+',
            'T_STRING' => '\w+',
        ];
    }
}
