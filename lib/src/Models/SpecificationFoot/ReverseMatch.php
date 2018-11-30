<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\Specification\AbstractSpecification;

class ReverseMatch extends AbstractSpecification
{
    /**
     * @param object $item
     * @return boolean
     */
    public function isSatisfedBy($item)
    {
        return $item->position_visitor_team->position < $item->position_home_team->position;
    }
}
