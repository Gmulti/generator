<?php

namespace Generator\Filters;

use Generator\Models\BaseFilter;

class UCFirst extends BaseFilter
{
    /**
     * @param string $value
     *
     * @return string
     */
    public function filter($value)
    {
        return  ucfirst($value);
    }
}
