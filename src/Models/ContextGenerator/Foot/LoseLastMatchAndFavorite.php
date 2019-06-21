<?php

namespace Generator\Models\ContextGenerator;

class LoseLastMatchAndFavorite extends SingleContext
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
