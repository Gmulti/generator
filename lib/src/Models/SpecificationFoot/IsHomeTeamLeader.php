<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\Specification\AbstractSpecification;

class IsHomeTeamLeader extends AbstractSpecification
{

    /**
     * @param object $item
     * @return boolean
     */
    public function isSatisfedBy($item)
    {
        return $item->position_home_team->position === 1;
    }
}
