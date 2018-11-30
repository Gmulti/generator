<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\Specification\AbstractSpecification;

class SubstractHomeToVisitorGreaterPosition extends AbstractSpecification
{

    /**     
     * @param string $string
     */
    public function __construct($string = 4){
        $this->string = $string;
    }

    /**
     * @param object $item
     * @return boolean
     */
    public function isSatisfedBy($item)
    {

        return $item->position_home_team->position - $item->position_visitor_team->position > $this->string;
    }
}
