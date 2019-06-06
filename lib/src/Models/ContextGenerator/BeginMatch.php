<?php

namespace Generator\Models\ContextGenerator;

use  Generator\Models\ContextGenerator\Base\BaseContextGenerator;

class BeginMatch extends BaseContextGenerator
{
    protected $text = '[[home_team#labels#name]] {accueille|reçoit|affronte} [[visitor_team#labels#name]]';

    protected $dataSpecTest = [
        [
            [
                'condition_test' => 'ReverseMatch',
                'invert'         => true,
            ],
        ],
    ];
}
