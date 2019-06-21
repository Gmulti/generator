<?php

namespace Generator\Models\ContextGenerator;

class BeginReverseMatchEasy extends SingleContext
{
    protected $text = 'Déplacement à priori facile de [[visitor_team#labels#name]] à [[home_team#labels#name]]';

    protected $dataSpecTest = [
        [
            [
                'condition_test' => 'ReverseMatch',
            ],
            [
                'condition_test' => 'SubstractHomeToVisitorGreaterPosition',
                'value'          => 10,
            ],
        ],
    ];
}
