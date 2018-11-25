<?php

namespace Generator\Models\SpecificationFoot\Base;

use Generator\Models\Specification\AbstractSpecification;

class BaseTeamHasNeverX extends AbstractSpecification
{
    protected $typeTeam = '';

    protected $typeResult = '';

    protected $at = "overall";

    /**
     * @param object $item
     * @return boolean
     */
    public function isSatisfedBy($item)
    {
        return $this->{$this->typeTeam}->overall->{$this->typeResult} === 0;
    }
}
