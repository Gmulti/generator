<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Generator\Factory\CreateSpecification;

final class CreateSpecificationGreaterTest extends TestCase
{
    public function setUp(): void
    {
        $this->specification = new CreateSpecification();
    }

    public function testCreateSpecificationIsGreaterThan()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'condition_test' => '>=',
                    'left'           => 3,
                ],
            ],
        ]);

        $this->assertTrue($spec->isSatisfedBy(3));
    }

    public function testCreateSpecificationIsStricklyGreaterThan()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'condition_test' => '>',
                    'left'          => 4,
                ],
            ],
        ]);

        $this->assertTrue($spec->isSatisfedBy(3));
    }

    public function testCreateSpecificationIsNotStricklyGreaterThan()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'condition_test' => '>',
                    'left'          => 3,
                ],
            ],
        ]);

        $this->assertFalse($spec->isSatisfedBy(3));
    }

    public function testCreateSpecificationIsGreaterThanWithString()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'condition_test' => 'greater_than',
                    'left'           => 3,
                ],
            ],
        ]);

        $this->assertTrue($spec->isSatisfedBy(3));
    }

    public function testCreateSpecificationIsStricklyGreaterThanWithString()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'condition_test' => 'strickly_greater_than',
                    'left'          => 4,
                ],
            ],
        ]);

        $this->assertTrue($spec->isSatisfedBy(3));
    }

    public function testCreateSpecificationIsNotStricklyGreaterThanWithString()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'condition_test' => 'strickly_greater_than',
                    'left'          => 3,
                ],
            ],
        ]);

        $this->assertFalse($spec->isSatisfedBy(3));
    }
}
