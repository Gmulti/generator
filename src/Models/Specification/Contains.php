<?php

namespace Generator\Models\Specification;

class Contains extends AbstractSpecification
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
        $pos = strpos($this->string, $item);

        if (false === $pos) {
            return false;
        } else {
            return true;
        }
    }
}
