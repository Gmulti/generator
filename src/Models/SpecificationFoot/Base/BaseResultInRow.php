<?php

namespace Generator\Models\SpecificationFoot\Base;

use Generator\Models\Specification\AbstractSpecification;

class BaseResultInRow extends AbstractSpecification
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
        $str = '';
        for ($i = 0; $i < $this->string; ++$i) {
            $str .= $this->typeResult;
        }

        return $recentForm === $str;
    }
}
