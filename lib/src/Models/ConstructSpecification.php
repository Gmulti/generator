<?php

namespace Generator\Models;

use Generator\Models\Specification\AbstractSpecification;

/**
 * @version 1.0.0
 *
 * @since 1.0.0
 *
 * @author Thomas DENEULIN <thomasdeneulin@gmail.com>
 */
interface ConstructSpecification
{
    /**
     * @param array $data
     * @return AbstractSpecification
     */
    public function constructSpecification($data) : AbstractSpecification;

}
