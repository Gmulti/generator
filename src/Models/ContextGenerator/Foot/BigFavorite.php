<?php

namespace Generator\Models\ContextGenerator;

class BigFavorite extends SingleContext
{
    protected $text = ' {en grandissime favori}';

    protected $dataSpecTest = [
        [
            [
                'condition_test' => 'WinInRowHomeTeam',
                'value'          => 3,
            ],
        ],
    ];
}
