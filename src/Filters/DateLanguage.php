<?php

namespace Generator\Filters;

use Generator\Models\BaseFilter;

class DateLanguage extends BaseFilter
{
    public function filter($value, $format = 'Y-m-d')
    {
        return strftime($format, $value);
    }
}
