<?php

namespace Generator\Models\Specification;

class StricklyGreaterThan extends AbstractSpecification
{
    /**
     * @param string $item
     *
     * @return bool
     */
    public function isSatisfedBy($item)
    {
        return $this->getValueStringFromItem($item) > $this->getValueTestFromItem($item);
    }
}
