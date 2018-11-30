<?php

error_reporting(-1);
ini_set('display_errors', 'On');

require_once __DIR__ . '/src/index.php';

use Generator\Models\Generator\Base\BaseGenerator;

$data = json_decode(file_get_contents(__DIR__ . '/test.json'));


// VisitorTeamReallyBestHomeTeam
// => Best Visitor Home

// Context dans context

try {
    $generators = [
        [
            "class" => "\Generator\Models\ContextGenerator\Many\BeginMatch",
        ],
        // [
        //     "class" => "\Generator\Models\ContextGenerator\LoseLastMatchAndFavorite", // Context
        // ],
        // [
        //     "class" => "\Generator\Models\ContextGenerator\Base\BaseContextGenerator",
        //     "dataSpecTest" => [
        //         [
        //             [
        //                 "condition_test" => "DrawInRowHomeTeam",
        //                 "value" => 1,
        //             ]
        //         ]
        //     ],
        // ],
        // [
        //     "class" => "\Generator\Models\ContextGenerator\Base\BaseContextGenerator",
        //     "dataSpecTest" => [
        //         [
        //             [
        //                 "condition_test" => "DrawInRowHomeTeam",
        //                 "value" => 1,
        //             ]
        //         ]
        //     ],
        //     "text" => " avec l'obligation de {s'imposer|prendre les 3 points|faire un résultat} après {son récent revers|sa récente défaite}"
        // ],
        // [
        //     "class" => "\Generator\Models\ContextGenerator\Base\BaseContextGenerator",
        //     "dataSpecTest" => [
        //         [
        //             [
        //                 "condition_test" => "IsTopMatch"
        //             ]
        //         ]
        //     ],
        // ]
    ];

    $baseGenerator = new BaseGenerator($generators);
    
    echo $baseGenerator->generate($data);
} catch (\Exception $e) {
    var_dump($e);
}
