<?php

namespace Generator\Services;

use Generator\Filters\Date;
use Generator\Filters\Uppercase;

class UseFilter
{

    /**
     * @param int $value
     * @param string $format
     * @return string
     */
    public function date($value, $format = 'd-m-Y'){
        return (new Date())->filter($value, $format);
    }

    /**
     *
     * @param string $value
     * @return string
     */
    public function uppercase($value){
        return (new Uppercase())->filter($value);
    }
    
}
