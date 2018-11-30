<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\Specification\AbstractSpecification;

class IsTopMatch extends AbstractSpecification
{
    /**
     * @param int $position
     */
    public function __construct($position = 6)
    {
        $this->position = $position;
    }

    /**
     * @param object $item
     * @return boolean
     */
    public function isSatisfedBy($item)
    {
        return $item->position_home_team->position + $item->position_visitor_team->position <= $this->position;
    }
}
