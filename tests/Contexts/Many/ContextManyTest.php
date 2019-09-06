<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Generator\TextGenerator;

final class ContextManyTest extends TestCase
{
    protected function setUp(): void
    {
        $this->data = json_decode(file_get_contents(__DIR__ . '/../../../data/tests-many.json'), true);
    }

    public function testManyContexts(): void
    {
        $generators = [
            [
                'contexts'=> [
                    [
                        'text'        => "[[player.name]] est désormais libre à l'issue de son contrat avec [[from_club]] ([[from_league]]).",
                        'dataSpecTest'=> [
                            [
                                [
                                    'operator'      => 'is_true',
                                    'value'         => '[[to_no_club]]',
                                ],
                            ],
                        ],
                    ],
                    [
                        'text'        => "[[player.name]] a décidé d'arrêter sa carrière {à l'issue|à la fin} de son contrat avec [[from_club]] ([[from_league]]).",
                        'dataSpecTest'=> [
                            [
                                [
                                    'operator'      => 'is_true',
                                    'value'         => '[[to_finish_career]]',
                                ],
                            ],
                        ],
                    ],
                    [
                        'text'        => '[[player.name]] change de club le [[#date_transfer]].',
                        'dataSpecTest'=> [],
                    ],
                ],
            ],
        ];

        $text = (new TextGenerator($generators))->generate($this->data);

        $this->assertThat(
            $text,
            $this->logicalOr(
                $this->equalTo("Peter Crouch a décidé d'arrêter sa carrière à l'issue de son contrat avec Burnley FC (Premier League)."),
                $this->equalTo("Peter Crouch a décidé d'arrêter sa carrière à la fin de son contrat avec Burnley FC (Premier League).")
            )
        );
    }
}
