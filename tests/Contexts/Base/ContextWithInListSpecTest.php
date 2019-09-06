<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Generator\TextGenerator;

final class ContextWithInListSpecTest extends TestCase
{
    protected function setUp(): void
    {
        $this->data = json_decode(file_get_contents(__DIR__ . '/../../../data/tests-simple.json'), true);
    }

    public function testDataSpecInListIsValid(): void
    {
        $contexts = [
            [
                'text'         => '[[home_team.name]] Joue avec Hulk',
                'dataSpecTest' => [
                    [
                        [
                            'operator'       => 'in_list',
                            'search'         => 'Hulk',
                            'list'           => '[[home_team.players]]',
                        ],
                    ],
                ],
            ],
        ];

        $text = (new TextGenerator($contexts))->generate($this->data);

        $this->assertEquals('Olympique Lyonnais Joue avec Hulk', $text);
    }

    public function testDataSpecInListIsNotValid(): void
    {
        $contexts = [
            [
                'text'         => '[[home_team.name]] Joue avec Iron Man',
                'dataSpecTest' => [
                    [
                        [
                            'operator'       => 'in_list',
                            'search'         => 'Iron Man',
                            'list'           => '[[home_team.players]]',
                        ],
                    ],
                ],
            ],
        ];

        $text = (new TextGenerator($contexts))->generate($this->data);
        $this->assertEmpty($text);
    }

    public function testContextWithReplaceFilter(): void
    {
        $contexts = [
            [
                'text'         => '[[home_team.name|replace("Lyon", "Big Lyon")]] Joue avec Iron Man',
            ],
        ];

        $text = (new TextGenerator($contexts))->generate($this->data);
        $this->assertEquals('Olympique Big Lyonnais Joue avec Iron Man', $text);
    }
}
