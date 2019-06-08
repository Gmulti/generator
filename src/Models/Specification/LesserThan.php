<?php

namespace Generator\Models\Specification;

class LesserThan extends AbstractSpecification
{
    /**
     * @param string $item
     *
     * @return bool
     */
    public function isSatisfedBy($item)
    {
        return $this->string <= $item;
    }
}
