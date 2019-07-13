<?php

namespace Generator\Services;

use Generator\Models\CanConstructSpecification;
use Generator\Models\CanGetSpecificationFactory;
use Generator\Factory\CreateSpecification;

class UseSpecificationFactory implements CanGetSpecificationFactory
{
    /**
     * @param CanConstructSpecification|null $factory
     */
    public function __construct(CanConstructSpecification $factory = null)
    {
        $this->specificationFactory = $factory;
    }

    /**
     * @return CanConstructSpecification
     */
    public function getSpecificationFactory(): CanConstructSpecification
    {
        if (is_null($this->specificationFactory)) {
            $this->specificationFactory = $this->createDefaultSpecificationFactory();
        }

        return $this->specificationFactory;
    }

    /**
     * @return CreateSpecification
     */
    protected function createDefaultSpecificationFactory(): CanConstructSpecification
    {
        return new CreateSpecification();
    }

    /**
     * @param CanConstructSpecification $factory
     *
     * @return Specification
     */
    public function setSpecificationFactory(CanConstructSpecification $factory)
    {
        $this->specificationFactory = $factory;

        return $this;
    }

    /**
     * @param array $data
     *
     * @return Generator\Models\CanConstructSpecification
     */
    public function constructSpecification($data)
    {
        return $this->getSpecificationFactory()
                    ->constructSpecification($data);
    }
}
