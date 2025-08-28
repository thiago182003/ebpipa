<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Boot the kernel to get Eloquent working
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

use App\Models\Pipeiro_user;
use Illuminate\Support\Facades\Hash;

// Inserção/atualização
$cpf = '703.725.164-08';
$user = Pipeiro_user::updateOrCreate([
    'cpf' => $cpf
], [
    'nome' => 'Thiago José Silva Souza',
    'identidade' => '9587619',
    'identidadeemissor' => 'SDS/PE',
    'email' => 'thiago182003@gmail.com',
    'password' => Hash::make('Thi4go18200#')
]);

echo "OK: user id={$user->id}\n";

$kernel->terminate($request, $response);
