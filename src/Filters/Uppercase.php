<?php

namespace Generator\Filters;

use Generator\Models\BaseFilter;

class Uppercase extends BaseFilter {

    /**
     *
     * @param string $value
     * @return string
     */
    public function filter($value){
        return  strtoupper($value);
    }

}