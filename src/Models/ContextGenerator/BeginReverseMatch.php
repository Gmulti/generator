<?php

namespace Generator\Models\ContextGenerator;

use  Generator\Models\ContextGenerator\Base\BaseContextGenerator;

class BeginReverseMatch extends BaseContextGenerator
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
