<?php

namespace Generator\Models\Specification;

/**
 * @version 1.0.0
 *
 * @since 1.0.0
 *
 * @author Thomas DENEULIN <thomasdeneulin@gmail.com>
 */
class NotX extends AbstractSpecification
{
    /**
     * @var SpecificationInterface
     */
    protected $specification;

    /**
     * @param SpecificationInterface $specification
     */
    public function __construct(SpecificationInterface $specification)
    {
        $this->specification = $specification;
    }

    /**
     * @param $item
     *
     * @return bool
     */
    public function isSatisfedBy($item)
    {
        return !$this->specification->isSatisfedBy($item);
    }
}
