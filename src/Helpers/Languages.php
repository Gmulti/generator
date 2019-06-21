<?php

namespace Generator\Helpers;

abstract class Languages
{
    const FR = 'fr';

    /**
     * @return array
     */
    public static function getLanguagesAvailable()
    {
        return [
            FR,
        ];
    }
}
