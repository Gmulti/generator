<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Generator\Factory\CreateSpecification;

final class CreateSpecificationTest extends TestCase
{
    public function setUp(): void
    {
        $this->specification = new CreateSpecification();
        $this->data = [
            [ // Or
                [ // AND
                    'condition_test' => 'equals',
                    'left'           => 'foo',
                ],
                [
                    'condition_test' => 'contains',
                    'left'           => 'foo',
                ],
            ],
            [ // OR
                [
                    'condition_test' => 'contains',
                    'left'           => 'bar',
                ],
            ],
        ];
    }

    public function testCreateSpecificationIsSatisfed()
    {
        $spec = $this->specification->constructSpecification($this->data);

        $this->assertTrue($spec->isSatisfedBy('foo'));
    }

    public function testCreateSpecificationIsNotSatisfed()
    {
        $spec = $this->specification->constructSpecification($this->data);

        $this->assertFalse($spec->isSatisfedBy('beer'));
    }

    public function testCreateSpecificationWithVariables()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'left'           => '#left',
                    'condition_test' => '<',
                    'right'          => '#right',
                ],
            ],
        ]);

        $this->assertTrue($spec->isSatisfedBy([
            'left'  => 3,
            'right' => 4,
        ]));
    }

    public function testCreateSpecificationWithVariablesWithFilters()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'left'           => '#time#starting_at|date("H")',
                    'condition_test' => '==',
                    'right'          => 15,
                ],
            ],
        ]);

        $this->assertTrue($spec->isSatisfedBy([
            'left'                => 3,
            'right'               => 4,
            'time'                => [
                'starting_at' => 1561131208,
            ],
        ]));
    }

    public function testCreateSpecificationWithVariablesWithFiltersOneQuote()
    {
        $spec = $this->specification->constructSpecification([
            [
                [
                    'left'           => "#time#starting_at|date('H')",
                    'condition_test' => '==',
                    'right'          => 15,
                ],
            ],
        ]);

        $this->assertTrue($spec->isSatisfedBy([
            'left'                => 3,
            'right'               => 4,
            'time'                => [
                'starting_at' => 1561131208,
            ],
        ]));
    }
}
