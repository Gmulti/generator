<?php

namespace Generator\Models\SpecificationFoot\Base;

use Generator\Models\Specification\AbstractSpecification;

class BaseIsTeamInLeague extends AbstractSpecification
{
    protected $typeTeam = '';

    protected $ids = [];

    /**
     * @param string $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }

    /**
     * @param object $item
     * @return boolean
     */
    public function isSatisfedBy($item)
    {
        return in_array($item->{$this->typeTeam}->id, $this->ids);
    }
}
