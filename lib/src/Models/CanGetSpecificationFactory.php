<?php

namespace Generator\Models;

/**
 * @version 1.0.0
 *
 * @since 1.0.0
 *
 * @author Thomas DENEULIN <thomasdeneulin@gmail.com>
 */
interface CanGetSpecificationFactory
{
    public function getSpecificationFactory(): ConstructSpecification;
}
