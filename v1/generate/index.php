<?php

require_once __DIR__.'/../../lib/vendor/autoload.php';

use Generator\Models\Generator\Base\BaseGenerator;
use Generator\Models\ContextGenerator\Base\BaseContextGenerator;

$_POST = json_decode(file_get_contents('php://input'), true);
$settings = $_POST['settings'];
$source = $_POST['source'];
try {
    header('Content-Type: application/json');

    $generators = [];

    foreach ($settings as $setting) {

        $item = $setting;
        if( ! array_key_exists('class', $setting)){
            $item['class'] = '\\Generator\\Models\\ContextGenerator\\Base\\BaseContextGenerator';
        }

        $generators[] = $item;
    }

    $baseGenerator = new BaseGenerator($generators);

    echo json_encode([
        'text' => $baseGenerator->generate($source),
    ]);
} catch (\Exception $e) {
    var_dump($e);
}
