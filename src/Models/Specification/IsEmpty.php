<?php

namespace Generator\Models\Specification;

class IsEmpty extends AbstractSpecification
{
    /**
     * @param string $item
     *
     * @return bool
     */
    public function isSatisfedBy($item)
    {
        return empty($this->getValueTestFromItem($item));
    }
}
