<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Generator\Filters\Date;

final class DateTest extends TestCase
{
    protected function setUp(): void
    {
        $this->data = 1561131208;
    }

    public function testDateFilterDefault(): void
    {
        $value = (new Date())->filter($this->data);
        $this->assertEquals('2019-06-21', $value);
    }

    public function testDateFilterWithFormat(): void
    {
        $value = (new Date())->filter($this->data, 'd M Y');
        $this->assertEquals('21 Jun 2019', $value);
    }

}
