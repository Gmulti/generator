<?php

namespace Generator\Models\Specification;

use Generator\Models\CanReplaceVariable;
use Generator\Services\VariableToString;

/**
 * @version 1.0.0
 *
 * @since 1.0.0
 *
 * @author Thomas DENEULIN <thomasdeneulin@gmail.com>
 */
abstract class AbstractSpecification implements SpecificationInterface
{
    protected $variable = null;

    /**
     * @param string $string
     */
    public function __construct($string, ?CanReplaceVariable $variableToString = null)
    {
        $this->string = $string;

        if (is_null($variableToString)) {
            $this->setDefaultVariableToStringService();
        } else {
            $this->variableToStringService = $variableToString;
        }
    }

    /**
     * @return void
     */
    public function setDefaultVariableToStringService(): void
    {
        $this->variableToStringService = new VariableToString();
    }

    /**
     * @param $variable
     *
     * @return void
     */
    public function setVariable($variable)
    {
        $this->variable = $variable;

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasAVariable(): bool
    {
        return !is_null($this->variable);
    }

    /**
     * @param any $item
     *
     * @return any
     */
    public function getValueTestFromItem($item)
    {
        if ($this->hasAVariable()) {
            return $this->variableToStringService
                        ->setDataSet($item)
                        ->getValueByVariableFromDataSet($this->variable);
        }

        return $item;
    }

    /**
     * @param $item
     *
     * @return bool
     */
    abstract public function isSatisfedBy($item);

    /**
     * @param SpecificationInterface $spec
     *
     * @return SpecificationInterface
     */
    public function andX(SpecificationInterface $spec)
    {
        return new AndX($this, $spec);
    }

    /**
     * @param SpecificationInterface $spec
     *
     * @return SpecificationInterface
     */
    public function orX(SpecificationInterface $spec)
    {
        return new OrX($this, $spec);
    }

    /**
     * @return SpecificationInterface
     */
    public function notX()
    {
        return new NotX($this);
    }
}
