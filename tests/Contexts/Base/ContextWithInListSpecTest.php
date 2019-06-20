<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Generator\Models\Generator\Base\BaseGenerator;

final class ContextWithInListSpecTest extends TestCase
{
    protected function setUp(): void
    {
        $this->data = json_decode(file_get_contents(__DIR__ . '/../../../data/data-tests-simple.json'), true);
    }

    public function testDataSpecInListIsValid(): void
    {
        $generators = [
            [
                'text'         => '[[home_team#name]] Joue avec Hulk',
                'dataSpecTest' => [
                    [
                        [
                            'condition_test' => 'in_list',
                            'value'          => 'Hulk',
                            'variable'       => 'home_team#players',
                        ],
                    ],
                ],
            ],
        ];

        $text = (new BaseGenerator($generators))->generate($this->data);

        $this->assertEquals('Olympique Lyonnais Joue avec Hulk', $text);
    }

    public function testDataSpecInListIsNotValid(): void
    {
        $generators = [
            [
                'text'         => '[[home_team#name]] Joue avec Iron Man',
                'dataSpecTest' => [
                    [
                        [
                            'condition_test' => 'in_list',
                            'value'          => 'Iron Man',
                            'variable'       => 'home_team#players',
                        ],
                    ],
                ],
            ],
        ];

        $text = (new BaseGenerator($generators))->generate($this->data);
        $this->assertEmpty($text);
    }
}
