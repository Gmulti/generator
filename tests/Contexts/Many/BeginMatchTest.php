<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Generator\Models\Generator\Base\BaseGenerator;

final class BeginMatchTest extends TestCase
{

    protected function setUp() : void
    {
        $this->data = json_decode( file_get_contents(__DIR__ . '/../../../data/angers-ol.json'), true);
    }


    public function testBeginMatchContextMany(): void
    {
        $generators = [
            [
                "class" => "\\Generator\\Models\\ContextGenerator\\Many\\BeginMatch"
            ]
        ];

        $text = (new BaseGenerator($generators))->generate($this->data);
        $this->logicalOr(
            $this->assertEquals('Déplacement à priori facile de Olympique Lyonnais à Angers', $text)
        );
    }
  
}
