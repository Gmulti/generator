<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Generator\Filters\Replace;

final class ReplaceTest extends TestCase
{

    public function testReplaceFilter(): void
    {
        $string = "before";
        $search =  "efo";
        $replace = "aze";

        $value = (new Replace())->filter($string, $search, $replace);
        $this->assertEquals('bazere', $value);
    }


}
