<?php

namespace Generator\Models\Specification;

use Generator\Models\Specification\AbstractSpecification;

class ContainsSpecification extends AbstractSpecification
{  
    /**     
     * @param string $string
     */
    public function __construct($string){
        $this->string = $string;
    }

    /** 
     * @param string $item
     * @return boolean
     */
    public function isSatisfedBy($item){    
        $pos = strpos($this->string, $item);

        if ($pos === false) {
            return false;
        } else {
            return true;
        }
    }
}