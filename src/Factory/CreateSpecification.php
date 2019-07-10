<?php

namespace Generator\Factory;

use Generator\Models\SpecificationConditionTest;
use Generator\Models\CanConstructSpecification;
use Generator\Models\Specification\AbstractSpecification;
use Generator\Models\Specification\NotX;
use Generator\Models\Specification\OrX;
use Generator\Models\Specification\AndX;
use Generator\Models\Specification\IsTrue;

class CreateSpecification implements SpecificationConditionTest, CanConstructSpecification
{
    const LEFT_KEYS = ['left', 'search', 'variable'];

    const RIGHT_KEYS = ['right', 'value', 'list'];

    public function __construct()
    {
        $this->conditionTest = [
            'equals'                   => "\Generator\Models\Specification\Equals",
            '==='                      => "\Generator\Models\Specification\Equals",
            'contains'                 => "\Generator\Models\Specification\Contains",
            'greater_than'             => "\Generator\Models\Specification\GreaterThan",
            '>='                       => "\Generator\Models\Specification\GreaterThan",
            'strickly_greater_than'    => "\Generator\Models\Specification\StricklyGreaterThan",
            '>'                        => "\Generator\Models\Specification\StricklyGreaterThan",
            'lesser_than'              => "\Generator\Models\Specification\LesserThan",
            '<='                       => "\Generator\Models\Specification\LesserThan",
            'strickly_lesser_than'     => "\Generator\Models\Specification\StricklyLesserThan",
            '<'                        => "\Generator\Models\Specification\StricklyLesserThan",
            'is_true'                  => "\Generator\Models\Specification\IsTrue",
            'is_false'                 => "\Generator\Models\Specification\IsFalse",
            'in_list'                  => "\Generator\Models\Specification\InList",
            'is_empty'                 => "\Generator\Models\Specification\IsEmpty",
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
     * @param string $key
     *
     * @return bool
     */
    public function conditionExist(string $key): bool
    {
        return array_key_exists($key, $this->conditionTest);
    }

    /**
     * @return AbstractSpecification
     */
    public function createSpecificationAlreadyTrue(): AbstractSpecification
    {
        return new IsTrue(true);
    }

    protected function getValueFromKeys($keys, $value){
        foreach($keys as $key){
            if(array_key_exists($key, $value)){
                return $value[$key];
            }
        }

        return null;
    }

    /**
     * @return string|bool
     */
    public function getLeftValue($value)
    {
       return $this->getValueFromKeys(self::LEFT_KEYS, $value);
    }

    /**
     * @return string|null
     */
    public function getRightValue($value)
    {
        return $this->getValueFromKeys(self::RIGHT_KEYS, $value);
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
            foreach ($valueOr as $keyAnd => $paramsAnd) {
                $invert = $paramsAnd['invert'] ?? false;

                $newSpec = $this->getSpecificationFromConditionTest($paramsAnd, $invert);
                
                $newSpec->setVariable(
                    $this->getRightValue($paramsAnd)
                );

                $arraySpec[$keyOr][] = $newSpec;
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

        if (empty($arraySpec)) {
            return $this->createSpecificationAlreadyTrue();
        }

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
     * @param array $paramsAnd
     * @param bool $invert
     *
     * @return Specification
     */
    public function getSpecificationFromConditionTest($paramsAnd, $invert = false)
    {   
        $conditionTest = $paramsAnd['condition_test'];
        $value = $this->getLeftValue($paramsAnd);
        
        if (!is_string($conditionTest)) {
            throw new \Exception('Condition test not a string');
        }
        if (!$this->conditionExist($conditionTest)) {
            throw new \Exception('Specification not exist');
        }

        $classSpecification = $this->conditionTest[$conditionTest];
        if ($invert) {
            $spec = new NotX(new $classSpecification($value));
        } else {
            $spec = new $classSpecification($value);
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
