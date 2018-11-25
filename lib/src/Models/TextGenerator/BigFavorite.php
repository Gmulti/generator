<?php

namespace Generator\Models\TextGenerator;

use  Generator\Models\TextGenerator\Base\BaseTextGenerator;

class BigFavorite extends BaseTextGenerator
{
    protected $text = " {en grandissime favori}";

    protected $dataSpecTest = [
        [
            [
                "condition_test" => "WinInRowHomeTeam",
                "value" => 3,
            ]
        ]
    ];

}
