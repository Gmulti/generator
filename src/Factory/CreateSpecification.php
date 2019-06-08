<?php

namespace Generator\Factory;

use Generator\Models\SpecificationConditionTest;
use Generator\Models\CanConstructSpecification;
use Generator\Models\Specification\AbstractSpecification;
use Generator\Models\Specification\NotX;
use Generator\Models\Specification\OrX;
use Generator\Models\Specification\AndX;

class CreateSpecification implements SpecificationConditionTest, CanConstructSpecification
{
    public function __construct()
    {
        $this->conditionTest = [
            'equals'                 => "\Generator\Models\Specification\Equals",
            'contains'               => "\Generator\Models\Specification\Contains",
            'greater_than'           => "\Generator\Models\Specification\GreaterThan",
            'strickly_greater_than'  => "\Generator\Models\Specification\StricklyGreaterThan",
            'lesser_than'            => "\Generator\Models\Specification\LesserThan",
            'strickly_lesser_than'   => "\Generator\Models\Specification\StricklyLesserThan",
            'is_true'                => "\Generator\Models\Specification\IsTrue",
        ];
    }

    /**
     * @param string $key
     * @param string $label
     *
     * @return CreateSpecification
     */
    public function setConditionTest($key, $label)
    {
        $this->conditionTest[$key] = $label;

        return $this;
    }

    /**
     * @return array
     */
    public function getConditionsTest(): array
    {
        return $this->conditionTest;
    }

    /**
     * @param array $data
     *
     * @return Specification
     */
    public function constructSpecification($data): AbstractSpecification
    {
        $arraySpec = [];

        foreach ($data as $keyOr => $valueOr) {
            foreach ($valueOr as $keyAnd => $valueAnd) {
                $invert = $valueAnd['invert'] ?? false;
                if (!array_key_exists('value', $valueAnd)) {
                    $arraySpec[$keyOr][] = $this->getSpecificationFromConditionTest($valueAnd['condition_test'], null, $invert);
                } else {
                    $arraySpec[$keyOr][] = $this->getSpecificationFromConditionTest($valueAnd['condition_test'], $valueAnd['value'], $invert);
                }
            }
        }

        $specification = $this->constructOrSpecification($arraySpec);

        return $specification;
    }

    /**
     * @param array $arraySpec
     *
     * @return Specification
     */
    protected function constructOrSpecification($arraySpec)
    {
        $specification = null;

        if (count($arraySpec) > 1) {
            foreach ($arraySpec as $key => $value) {
                if (array_key_exists($key + 1, $arraySpec)) {
                    $specification = (null === $specification) ?
                                      new OrX($this->constructAndSpecification($value), $this->constructAndSpecification($arraySpec[$key + 1])) :
                                      new OrX($specification, $this->constructAndSpecification($arraySpec[$key + 1]));
                } else {
                    $specification = new OrX($specification, $this->constructAndSpecification($value));
                }
            }
        } else {
            $arraySpec = array_values($arraySpec);
            $specification = $this->constructAndSpecification($arraySpec[0]);
        }

        return $specification;
    }

    /**
     * @param array $andSpecs
     *
     * @return Specification
     */
    protected function constructAndSpecification($andSpecs)
    {
        $andSpecification = null;

        if (!empty($andSpecs) && 1 === count($andSpecs)) {
            return $andSpecs[0];
        } else {
            foreach ($andSpecs as $key => $value) {
                if (array_key_exists($key + 1, $andSpecs)) {
                    $andSpecification = (null === $andSpecification) ?
                                        new AndX($value, $andSpecs[$key + 1]) :
                                        new AndX($andSpecification, $andSpecs[$key + 1]);
                }
            }
        }

        return $andSpecification;
    }

    /**
     * @param string $conditionTest
     * @param string $value
     *
     * @return Specification
     */
    public function getSpecificationFromConditionTest($conditionTest, $value = null, $invert = false)
    {
        if (is_string($conditionTest)) {
            if (!array_key_exists($conditionTest, $this->conditionTest)) {
                return false;
            }

            $classSpecification = $this->conditionTest[$conditionTest];

            if ($invert) {
                $spec = new NotX(new $classSpecification($value));
            } else {
                $spec = new $classSpecification($value);
            }
        }

        // @TODO : CALLBACK
        // else {
        //     var_dump('here');
        //     var_dump($conditionTest);
        //     die;
        // }

        return $spec;
    }
}
