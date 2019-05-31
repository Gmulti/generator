<?php

namespace Generator\Models\SpecificationFoot;

use Generator\Models\Specification\AbstractSpecification;

class HomeTeamPositionGreaterThan extends AbstractSpecification
{
    /**
     * @param string $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }

    /**
     * @param object $item
     *
     * @return bool
     */
    public function isSatisfedBy($item)
    {
        return $item['position_home_team']['position'] < $this->string;
    }
}
