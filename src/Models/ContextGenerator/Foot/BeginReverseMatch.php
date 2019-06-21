<?php

namespace Generator\Models\ContextGenerator;

class BeginReverseMatch extends SingleContext
{
    protected $text = '[[visitor_team#labels#name]] {est en déplacement|se déplace|rend visite} à [[home_team#labels#name]]';

    protected $dataSpecTest = [
        [
            [
                'condition_test' => 'ReverseMatch',
            ],
        ],
    ];
}
