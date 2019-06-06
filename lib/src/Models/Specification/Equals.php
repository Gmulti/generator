<?php

namespace Generator\Models\Specification;

class Equals extends AbstractSpecification
{
    /**
     * @param string $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }

    /**
     * @param string $item
     *
     * @return bool
     */
    public function isSatisfedBy($item)
    {
        return $this->string === $item;
    }
}
