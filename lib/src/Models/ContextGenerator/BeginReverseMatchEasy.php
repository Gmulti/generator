<?php

namespace Generator\Models\ContextGenerator;

use  Generator\Models\ContextGenerator\Base\BaseContextGenerator;

class BeginReverseMatchEasy extends BaseContextGenerator
{
    protected $text = "Déplacement à priori facile de [[visitor_team]] à [[home_team]]";

    protected $dataSpecTest = [
        [
            [
                "condition_test" => "ReverseMatch",
            ],
            [
                "condition_test" => "SubstractHomeToVisitorGreaterPosition",
                "value" => 10
            ]
        ]
    ];
}
