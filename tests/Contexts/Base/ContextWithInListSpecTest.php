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
                'text'         => 'Dans la bonne ligue [[home_team#league_names#fr#title]]',
                'dataSpecTest' => [
                    [
                        [
                            'condition_test' => 'in_list',
                            'value'          => 'FR',
                            'variable'       => 'home_team#league_ids',
                        ],
                    ],
                ],
            ],
        ];

        $text = (new BaseGenerator($generators))->generate($this->data);
        $this->assertEquals('Dans la bonne ligue Française', $text);
    }

    public function testDataSpecInListIsNotValid(): void
    {
        $generators = [
            [
                'text'         => 'Dans la bonne ligue [[home_team#league_names#fr#title]]',
                'dataSpecTest' => [
                    [
                        [
                            'condition_test' => 'in_list',
                            'value'          => 'AL',
                            'variable'       => 'home_team#league_ids',
                        ],
                    ],
                ],
            ],
        ];

        $text = (new BaseGenerator($generators))->generate($this->data);
        $this->assertEmpty($text);
    }
}
