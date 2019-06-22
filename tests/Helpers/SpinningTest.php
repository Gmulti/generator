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
    public function testDoubleSpinningValue(): void
    {
        $string = '{magic {foo|bar}|iron {man|first}}';
        $value = Spinning::process($string);
        $this->assertThat(
            $value,
            $this->logicalOr(
                $this->equalTo('magic foo'),
                $this->equalTo('magic bar'),
                $this->equalTo('iron man'),
                $this->equalTo('iron first')
            )
        );
    }
}
