<?php

namespace Generator\Models\Specification\Compose;

use Generator\Compose\DefaultVariableService;

trait UseVariableSpecification
{
    use DefaultVariableService;

    protected $variable = null;

    /**
     * @param $variable
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasAVariable(): bool
    {
        return !is_null($this->variable);
    }

    public function getValueStringFromItem($item)
    {
        $leftValue = $this->string;
        if ($this->getVariableToStringService()->isVariable($leftValue)) {
            $leftValue = $this->getVariableToStringService()->setDataSet($item)
                              ->getValueByVariableFromDataSet($leftValue);
        }

        return $leftValue;
    }

    /**
     * @param any $item
     *
     * @return any
     */
    public function getValueTestFromItem($item)
    {
        if ($this->hasAVariable()) {
            return $this->getVariableToStringService()
                        ->setDataSet($item)
                        ->getValueByVariableFromDataSet($this->variable);
        }

        return $item;
    }
}
