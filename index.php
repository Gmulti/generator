<?php

require_once __DIR__.'/lib/vendor/autoload.php';

// if( file_exists(__DIR__ . $_SERVER['REQUEST_URI'])))
// if(empty($uri)){
//     return;
// }

use Generator\Models\Generator\Base\BaseGenerator;

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $_POST = json_decode(file_get_contents('php://input'), true);

//     $data = json_decode(json_encode($_POST['data']), false);
//     $config = $_POST['config'];
// } else {
$data = json_decode(file_get_contents(__DIR__.'/data/test.json'));
$config = [
    [
        'class' => "\Generator\Models\ContextGenerator\Many\BeginMatch",
    ],
];
// }

try {
    $generators = [
        [
            'class' => "\Generator\Models\ContextGenerator\Many\BeginMatch",
        ],
        [
            'class' => "\Generator\Models\ContextGenerator\LoseLastMatchAndFavorite", // Context
        ],
        [
            'class' => "\Generator\Models\ContextGenerator\Base\BaseContextGenerator",
            'dataSpecTest' => [
                [
                    [
                        'condition_test' => 'DrawInRowHomeTeam',
                        'value' => 1,
                    ],
                ],
            ],
        ],
        [
            'class' => "\Generator\Models\ContextGenerator\Base\BaseContextGenerator",
            'dataSpecTest' => [
                [
                    [
                        'condition_test' => 'DrawInRowHomeTeam',
                        'value' => 1,
                    ],
                ],
            ],
            'text' => " avec l'obligation de {s'imposer|prendre les 3 points|faire un résultat} après {son récent revers|sa récente défaite}",
        ],
        [
            'class' => "\Generator\Models\ContextGenerator\Base\BaseContextGenerator",
            'dataSpecTest' => [
                [
                    [
                        'condition_test' => 'IsTopMatch',
                    ],
                ],
            ],
        ],
    ];

    header('Content-Type: application/json');
    $baseGenerator = new BaseGenerator($config);

    echo json_encode([
        'text' => $baseGenerator->generate($data),
    ]);
} catch (\Exception $e) {
    var_dump($e);
}
