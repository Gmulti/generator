<?php

namespace Generator\Models\ContextGenerator;

use  Generator\Models\ContextGenerator\Base\BaseContextGenerator;

class LoseLastMatchAndFavorite extends BaseContextGenerator
{
    protected $text = " avec l'obligation de {s'imposer|prendre les 3 points|faire un résultat} après {son récent revers|sa récente défaite}";

    protected $dataSpecTest = [
        [
            [
                'condition_test' => 'LoseInRowHomeTeam',
                'value'          => 1,
            ],
        ],
    ];
}
