<?php

namespace Generator\Models\ContextGenerator;

use  Generator\Models\ContextGenerator\Base\BaseContextGenerator;

class BigFavorite extends BaseContextGenerator
{
    protected $text = ' {en grandissime favori}';

    protected $dataSpecTest = [
        [
            [
                'condition_test' => 'WinInRowHomeTeam',
                'value' => 3,
            ],
        ],
    ];
}
