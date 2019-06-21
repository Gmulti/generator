<?php

namespace Generator\Models\ContextGenerator;

class BeginMatch extends SingleContext
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
