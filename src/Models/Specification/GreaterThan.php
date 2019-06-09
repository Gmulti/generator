<?php

namespace Generator\Models\Specification;

class GreaterThan extends AbstractSpecification
{
    /**
     * @param string $item
     *
     * @return bool
     */
    public function isSatisfedBy($item)
    {
        return $this->string >= $this->getValueTestFromItem($item);
    }
}
