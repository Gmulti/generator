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
                    'value'          => 'foo',
                ],
                [
                    'condition_test' => 'contains',
                    'value'          => 'foo',
                ],
            ],
            [ // OR
                [
                    'condition_test' => 'contains',
                    'value'          => 'bar',
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
}
