<?php

error_reporting(-1);
ini_set('display_errors', 'On');

require_once __DIR__ . '/src/index.php';

use Generator\Models\Generator\Base\BaseGenerator;

$data = json_decode(file_get_contents(__DIR__ . '/test.json'));

try {
    $generators = [
        [
            "class" => "\Generator\Models\TextGenerator\LoseLastMatchAndFavorite",
        ],
        [
            "class" => "\Generator\Models\TextGenerator\Base\BaseTextGenerator",
            "dataSpecTest" => [
                [
                    [
                        "condition_test" => "DrawInRowHomeTeam",
                        "value" => 1,
                    ]
                ]
            ],
            "text" => " avec l'obligation de {s'imposer|prendre les 3 points|faire un résultat} après {son récent revers|sa récente défaite}"
        ]
    ];

    $baseGenerator = new BaseGenerator($generators);
    
    echo $baseGenerator->generate($data);
} catch (\Exception $e) {
    var_dump($e);
}
