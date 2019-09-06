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
                    'operator' => 'lesser_than',
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
                    'operator' => 'strickly_lesser_than',
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
                    'operator' => 'strickly_lesser_than',
                    'value'          => 3,
                ],
            ],
        ]);

        $this->assertFalse($spec->isSatisfedBy(3));
    }

    public function testCreateSpecificationIsLesserThanWithSymbol()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'operator' => '<=',
                    'value'          => 3,
                ],
            ],
        ]);

        $this->assertTrue($spec->isSatisfedBy(3));
    }

    public function testCreateSpecificationIsStricklyLesserThanWithSymbol()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'operator' => '<',
                    'value'          => 2,
                ],
            ],
        ]);

        $this->assertTrue($spec->isSatisfedBy(3));
    }

    public function testCreateSpecificationIsNotStricklyLesserThanWithSymbol()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'operator' => '<',
                    'value'          => 3,
                ],
            ],
        ]);

        $this->assertFalse($spec->isSatisfedBy(3));
    }

    public function testCreateSpecificationIsLesserThanWithVariables()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'left'           => '#left',
                    'operator' => '<',
                    'right'          => '#right',
                ],
            ],
        ]);

        $this->assertTrue($spec->isSatisfedBy([
            'left'  => 3,
            'right' => 4,
        ]));
    }
}
