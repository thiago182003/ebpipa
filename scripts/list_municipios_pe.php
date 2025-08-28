<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

$est = App\Models\Estado::where('sigla', 'PE')->first();
if ($est) {
    foreach ($est->municipios()->orderBy('nome')->get() as $m) {
        echo $m->nome . PHP_EOL;
    }
} else {
    echo "Estado PE nao encontrado" . PHP_EOL;
}

$kernel->terminate($request, $response);
