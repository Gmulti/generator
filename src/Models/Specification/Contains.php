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
        $value = $this->getValueTestFromItem($item);
        if (is_int($value)) {
            return false;
        }

        $pos = strpos($this->getValueStringFromItem($item), $value);

        if (false === $pos) {
            return false;
        } else {
            return true;
        }
    }
}
