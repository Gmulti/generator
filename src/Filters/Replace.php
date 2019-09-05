<?php

namespace Generator\Filters;

use Generator\Models\BaseFilter;

class Replace extends BaseFilter
{
    public function filter($value, $search = null, $replace = null)
    {
        if (null === $search || null === $replace) {
            return $value;
        }

        return str_replace($search, $replace, $value);
    }
}
