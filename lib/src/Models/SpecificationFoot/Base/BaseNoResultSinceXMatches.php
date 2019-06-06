<?php

namespace Generator\Models\SpecificationFoot\Base;

use Generator\Models\Specification\AbstractSpecification;

class BaseNoResultSinceXMatches extends AbstractSpecification
{
    protected $typeTeam = '';

    protected $typeResult = '';

    /**
     * @param string $string
     */
    public function __construct($string = 5)
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
        $recentForm = str_split($item[$this->typeTeam]['recent_form'], $this->string)[0];

        return false === strpos($recentForm, $this->typeResult);
    }
}
