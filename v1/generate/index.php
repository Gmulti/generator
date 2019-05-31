<?php

require_once __DIR__.'/../../lib/vendor/autoload.php';

use Generator\Models\Generator\Base\BaseGenerator;

$_POST = json_decode(file_get_contents('php://input'), true);
$settings = $_POST['settings'];
$source = $_POST['source'];
try {
    header('Content-Type: application/json');
    $baseGenerator = new BaseGenerator($settings);

    echo json_encode([
        'text' => $baseGenerator->generate($source),
    ]);
} catch (\Exception $e) {
    var_dump($e);
}
