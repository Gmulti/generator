<?php

namespace Generator\Filters;

use Generator\Models\BaseFilter;

class Date extends BaseFilter
{
    public function filter($value, $format = 'Y-m-d')
    {
        $date = new \DateTime();

        return $date->setTimestamp($value)->format($format);
    }
}
