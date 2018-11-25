<?php
namespace Generator\Models\Specification;

use Generator\Models\Specification\SpecificationInterface;
use Generator\Models\Specification\AndX;
use Generator\Models\Specification\OrX;
use Generator\Models\Specification\NotX;

/**
 * @version 1.0.0
 * @since 1.0.0
 * 
 * @author Thomas DENEULIN <thomasdeneulin@gmail.com> 
 */
abstract class AbstractSpecification implements SpecificationInterface
{
    /**
     *
     * @param $item
     *
     * @return bool
     */
    abstract public function isSatisfedBy($item);

    /**
     *
     * @param SpecificationInterface $spec
     *
     * @return SpecificationInterface
     */
    public function andX(SpecificationInterface $spec)
    {
        return new AndX($this, $spec);
    }

    /**
     *
     * @param SpecificationInterface $spec
     *
     * @return SpecificationInterface
     */
    public function orX(SpecificationInterface $spec)
    {
        return new OrX($this, $spec);
    }

    /**
     *
     * @return SpecificationInterface
     */
    public function notX()
    {
        return new NotX($this);
    }
}