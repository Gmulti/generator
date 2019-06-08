<?php

namespace Generator\Models\Specification;

class Contains extends AbstractSpecification
{
    /**
     * @param string $item
     *
     * @return bool
     */
    public function isSatisfedBy($item)
    {
        if (is_int($item)) {
            return false;
        }

        $pos = strpos($this->string, $item);

        if (false === $pos) {
            return false;
        } else {
            return true;
        }
    }
}
