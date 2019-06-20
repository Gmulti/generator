<?php

namespace Generator\Models\Specification;

class Equals extends AbstractSpecification
{

    /**
     * @param string $item
     *
     * @return bool
     */
    public function isSatisfedBy($item)
    {
        return $this->string === $this->getValueTestFromItem($item);
    }
}
