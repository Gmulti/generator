<?php

namespace Generator\Models\Specification;

use Generator\Models\Specification\AbstractSpecification;

class Equals extends AbstractSpecification
{   
    /**
     *
     * @param string $string
     */
    public function __construct($string){
          $this->string = $string;
    }

    /**
     *
     * @param string $item
     * @return boolean
     */
    public function isSatisfedBy($item){     
        return $this->string === $item;
    }
}