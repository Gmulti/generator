<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Generator\Filters\Uppercase;

final class UppercaseTest extends TestCase
{
    protected function setUp(): void
    {
        $this->data = 'iron man';
    }

    public function testUppercaseFilter(): void
    {
        $value = (new Uppercase())->filter($this->data);
        $this->assertEquals('IRON MAN', $value);
    }

}
