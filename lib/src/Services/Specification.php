<?php

namespace Generator\Services;

use Generator\Models\SpecificationFactoryInterface;
use Generator\Models\ServiceInterface;
use Generator\Factory\Specification\SpecificationFactory;

class Specification implements ServiceInterface
{
    /**
     * @param SpecificationFactoryInterface|null $factory 
     */
    public function __construct(SpecificationFactoryInterface $factory = null){
        $this->specificationFactory = $factory;

        $this->createDefaultSpecificationFoot();
    }

    public function createDefaultSpecificationFoot(){
        $files      = array_diff(scandir(GENERATOR_DIR . '/Models/SpecificationFoot'), [ '..', '.' ]);
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
     * @return SpecificationFactoryInterface
     */
    public function getSpecificationFactory(){
        if (is_null($this->specificationFactory)) {
            $this->specificationFactory = $this->createDefaultSpecificationFactory();
        }

        return $this->specificationFactory;
    }

    /**
     * @return SpecificationFactory
     */
    public function createDefaultSpecificationFactory(){
        return new SpecificationFactory();
    }
    


    /**
     *
     * @param SpecificationFactoryInterface $factory
     * @return Specification
     */
    public function setFactory(SpecificationFactoryInterface $factory){
        $this->specificationFactory = $factory;
        return $this;
    }

    /**
     *
     * @param array $data
     * @return Generator\Models\SpecificationFactoryInterface
     */
    public function constructSpecification($data){
        return $this->getSpecificationFactory()
                    ->constructSpecification($data);
    }
}