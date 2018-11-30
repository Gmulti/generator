<?php
var_dump($_SERVER);
// require_once __DIR__ . '/../../lib/src/index.php';

// use Generator\Models\Generator\Base\BaseGenerator;

// $data = $_POST['data'];
// $generators = $_POST['generators'];
var_dump($_POST);
$_POST = json_decode(file_get_contents('php://input'), true);

var_dump($_POST);
// var_dump(json_decode($data, true));
// var_dump(json_decode($generators, true));
die;

// try {
//     $generators = [
//         [
//             "class" => "\Generator\Models\ContextGenerator\LoseLastMatchAndFavorite",
//             // "dataSpecTest" => [
//             //     [
//             //         [
//             //             "condition_test" => "DrawInRowHomeTeam",
//             //             "value" => 1,
//             //         ]
//             //     ]
//             // ],
//             // "text" => "bogoss"
//         ]
//     ];

//     // $baseGenerator = new BaseGenerator($generators);
//     echo "ok";
//     die;
//     echo $baseGenerator->generate($data);
// } catch (\Exception $e) {
//     var_dump($e);
// }
