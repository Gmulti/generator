<?php

namespace Generator\Factory\Specification;

use Generator\Models\SpecificationFactoryInterface;
use Generator\Models\Specification\NotX;
use Generator\Models\Specification\OrX;
use Generator\Models\Specification\AndX;

class SpecificationFactory implements SpecificationFactoryInterface
{
    public function __construct()
    {
        $this->conditionTest = array(
            'equals' => "\Generator\Models\Specification\EqualsSpecification",
            'contains' => "\Generator\Models\Specification\ContainsSpecification",
        );
    }

    /**
     * @param string $key
     * @param string $label
     *
     * @return SpecificationFactory
     */
    public function setConditionTest($key, $label)
    {
        $this->conditionTest[$key] = $label;

        return $this;
    }

    /**
     * @return array
     */
    public function getConditionsTest()
    {
        return $this->conditionTest;
    }

    /**
     * @param array $data
     *
     * @return Specification
     */
    public function constructSpecification($data)
    {
        $arraySpec = array();

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
                    $specification = ($specification === null) ?
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

        if (!empty($andSpecs) && count($andSpecs) === 1) {
            return $andSpecs[0];
        } else {
            foreach ($andSpecs as $key => $value) {
                if (array_key_exists($key + 1, $andSpecs)) {
                    $andSpecification = ($andSpecification === null) ?
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
