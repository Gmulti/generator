<?php

namespace Generator\Models\Specification;

use Generator\Models\Specification\AbstractSpecification;

class IsTrue extends AbstractSpecification
{

    /**
     *
     * @param string $item
     * @return boolean
     */
    public function isSatisfedBy($item)
    {
        return true;
    }
}
