<?php

namespace Generator\Models\Specification;

class IsTrue extends AbstractSpecification
{
    /**
     * @param string $item
     *
     * @return bool
     */
    public function isSatisfedBy($item)
    {
        return true === boolval($this->getValueTestFromItem($item));
    }
}
