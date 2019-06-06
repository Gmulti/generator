<?php

namespace Generator\Services;

use Generator\Models\ConstructSpecification;
use Generator\Models\CanGetSpecificationFactory;
use Generator\Factory\Specification\SpecificationFactory;

class UseSpecificationFactory implements CanGetSpecificationFactory
{
    /**
     * @param ConstructSpecification|null $factory
     */
    public function __construct(ConstructSpecification $factory = null)
    {
        $this->specificationFactory = $factory;
        $this->createDefaultSpecificationFoot();
    }

    public function createDefaultSpecificationFoot()
    {
        $files = array_diff(scandir(__DIR__ . '/../Models/SpecificationFoot'), ['..', '.']);
        foreach ($files as $filename) {
            $file = str_replace('.php', '', $filename);
            $class = '\\Generator\\Models\\SpecificationFoot\\' . $file;

            $name = $file;
            if (defined($class . '::NAME')) {
                $name = $class::NAME;
            }
            $this->getSpecificationFactory()->setConditionTest($name, $class);
        }
    }

    /**
     * @return ConstructSpecification
     */
    public function getSpecificationFactory(): ConstructSpecification
    {
        if (is_null($this->specificationFactory)) {
            $this->specificationFactory = $this->createDefaultSpecificationFactory();
        }

        return $this->specificationFactory;
    }

    /**
     * @return SpecificationFactory
     */
    protected function createDefaultSpecificationFactory(): ConstructSpecification
    {
        return new SpecificationFactory();
    }

    /**
     * @param ConstructSpecification $factory
     *
     * @return Specification
     */
    public function setSpecificationFactory(ConstructSpecification $factory)
    {
        $this->specificationFactory = $factory;

        return $this;
    }

    /**
     * @param array $data
     *
     * @return Generator\Models\ConstructSpecification
     */
    public function constructSpecification($data)
    {
        return $this->getSpecificationFactory()
                    ->constructSpecification($data);
    }
}
