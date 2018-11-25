<?php

namespace Generator\Models\TextGenerator;

use  Generator\Models\TextGenerator\Base\BaseTextGenerator;


class LoseLastMatchAndFavorite extends BaseTextGenerator
{
    protected $text = " avec l'obligation de {s'imposer|prendre les 3 points|faire un résultat} après {son récent revers|sa récente défaite}";

    protected $dataSpecTest = [
        [
            [
                "condition_test" => "LoseInRowHomeTeam",
                "value" => 1,
            ]
        ]
    ];

}
