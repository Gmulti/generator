<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Generator\Factory\CreateSpecification;

final class CreateSpecificationLesserTest extends TestCase
{
    public function setUp(): void
    {
        $this->specification = new CreateSpecification();
    }

    public function testCreateSpecificationIsLesserThan()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'condition_test' => 'lesser_than',
                    'value'          => 3,
                ],
            ],
        ]);

        $this->assertTrue($spec->isSatisfedBy(3));
    }

    public function testCreateSpecificationIsStricklyLesserThan()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'condition_test' => 'strickly_lesser_than',
                    'value'          => 2,
                ],
            ],
        ]);

        $this->assertTrue($spec->isSatisfedBy(3));
    }

    public function testCreateSpecificationIsNotStricklyLesserThan()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'condition_test' => 'strickly_lesser_than',
                    'value'          => 3,
                ],
            ],
        ]);

        $this->assertFalse($spec->isSatisfedBy(3));
    }
}
