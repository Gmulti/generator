<?php

namespace Generator\Services;

use Generator\Filters\Date;
use Generator\Filters\Uppercase;
use Generator\Filters\Lowercase;
use Generator\Filters\UCFirst;
use Generator\Filters\DateLanguage;
use Generator\Filters\Replace;

class UseFilter
{
    /**
     * @param int    $value
     * @param string $format
     *
     * @return string
     */
    public function date($value, $format = 'd-m-Y')
    {
        return (new Date())->filter($value, $format);
    }

    /**
     * @param string $value
     * @param string $search
     * @param string $replace
     */
    public function replace($value, $search = null, $replace = null)
    {
        return (new Replace())->filter($value, $search, $replace);
    }

    /**
     * @param int    $value
     * @param string $format
     *
     * @return string
     */
    public function datelanguage($value, $format = 'd-m-Y')
    {
        return (new DateLanguage())->filter($value, $format);
    }

    /**
     * @param string $value
     *
     * @return string
     */
    public function uppercase($value)
    {
        return (new Uppercase())->filter($value);
    }

    /**
     * @param string $value
     *
     * @return string
     */
    public function lowercase($value)
    {
        return (new Lowercase())->filter($value);
    }

    /**
     * @param string $value
     */
    public function ucfirst($value)
    {
        return (new UCFirst())->filter($value);
    }
}
