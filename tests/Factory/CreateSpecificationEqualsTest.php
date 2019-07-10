<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Generator\Factory\CreateSpecification;

final class CreateSpecificationEqualsTest extends TestCase
{
    public function setUp(): void
    {
        $this->specification = new CreateSpecification();
    }
    
    public function testCreateSpecificationEqualsIsSatisfed()
    {
        $spec = $this->specification->constructSpecification([
            [ // Or
                [
                    'condition_test' => 'equals',
                    'left'           => 'foo',
                ]
            ]
        ]);

        $this->assertTrue($spec->isSatisfedBy("foo"));
    }

    public function testCreateSpecificationEqualsIsNotSatisfedLeftAndRight()
    {
        $spec = $this->specification->constructSpecification([
            [ // Or
                [
                    'condition_test' => 'equals',
                    'left'           => 'foo',
                    'right'          => 'beer'
                ]
            ]
        ]);

        $this->assertFalse($spec->isSatisfedBy(["iron" => "man"]));
    }
    
    public function testCreateSpecificationEqualsIsSatisfedLeftAndRight()
    {
        $spec = $this->specification->constructSpecification([
            [ // Or
                [
                    'condition_test' => 'equals',
                    'left'           => 'foo',
                    'right'          => 'foo'
                ]
            ]
        ]);

        $this->assertTrue($spec->isSatisfedBy(["iron" => "man"]));
    }
}
