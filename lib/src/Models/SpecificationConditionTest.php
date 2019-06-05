<?php

namespace Generator\Models;

/**
 * @version 1.0.0
 *
 * @since 1.0.0
 *
 * @author Thomas DENEULIN <thomasdeneulin@gmail.com>
 */
interface SpecificationConditionTest
{
     /**
     * @param string $key
     * @param string $label
     */
    public function setConditionTest($key, $label);

    /**
     * @return array
     */
    public function getConditionsTest() : array;
}
