<?php

namespace Generator\Models\Specification;

class IsFalse extends AbstractSpecification
{
    /**
     * @param string $item
     *
     * @return bool
     */
    public function isSatisfedBy($item)
    {
        return false === boolval($this->getValueTestFromItem($item));
    }
}
