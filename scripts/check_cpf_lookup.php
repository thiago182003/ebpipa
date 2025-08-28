<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

$cpf = preg_replace('/\D/', '', '703.725.164-08');
$user = App\Models\Pipeiro_user::whereRaw("REPLACE(REPLACE(REPLACE(cpf, '.', ''), '-', ''), ' ', '') = ?", [$cpf])->first();

if ($user) {
    echo "FOUND: id={$user->id}, nome={$user->nome}, cpf={$user->cpf}\n";
} else {
    echo "NOT FOUND\n";
}

$kernel->terminate($request, $response);
