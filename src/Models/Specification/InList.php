<?php

namespace Generator\Models\Specification;

class InList extends AbstractSpecification
{
    /**
     * @param string $item
     *
     * @return bool
     */
    public function isSatisfedBy($item)
    {
        return in_array($this->getValueStringFromItem($item), $this->getValueTestFromItem($item), true);
    }
}
