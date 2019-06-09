<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Generator\Helpers\Spinning;

final class SpinningTest extends TestCase
{
    public function testSpinningValue(): void
    {
        $string = '{foo|bar}';
        $value = Spinning::process($string);
        $this->assertThat(
            $value,
            $this->logicalOr(
                $this->equalTo('foo'),
                $this->equalTo('bar')
            )
        );
    }
}
