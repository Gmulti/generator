<?php

namespace Generator\Models\Specification;

use Generator\Models\CanReplaceVariable;

interface CanUseVariable
{
    public function setDefaultVariableToStringService(): void;

    /**
     * @return CanReplaceVariable
     */
    public function getVariableToStringService(): CanReplaceVariable;

    /**
     * @param $variable
     */
    public function setVariable($variable);

    /**
     * @return bool
     */
    public function hasAVariable(): bool;

    public function getValueStringFromItem($item);

    /**
     * @param any $item
     *
     * @return any
     */
    public function getValueTestFromItem($item);
}
