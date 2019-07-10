<?php

namespace Generator\Filters;

use Generator\Models\BaseFilter;

class Lowerrcase extends BaseFilter
{
    /**
     * @param string $value
     *
     * @return string
     */
    public function filter($value)
    {
        return  strtolower($value);
    }
}
