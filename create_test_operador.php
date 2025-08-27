<?php

require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$app->boot();

use App\Models\Operador_user;

// Verificar se já existe um operador
$operadores = Operador_user::count();
echo "Operadores existentes: $operadores\n";

if ($operadores == 0) {
    // Criar um operador de teste
    $operador = new Operador_user();
    $operador->nome = 'Operador Teste';
    $operador->nomeguerra = 'Teste';
    $operador->identidade = '123456789';
    $operador->email = 'operador@teste.com';
    $operador->cpf = '12345678901';
    $operador->password = bcrypt('123456');
    $operador->id_om = 1; // Pode precisar ajustar se não existir
    $operador->id_pg = 1; // Pode precisar ajustar se não existir
    
    try {
        $operador->save();
        echo "Operador de teste criado com sucesso!\n";
        echo "CPF: 12345678901\n";
        echo "Senha: 123456\n";
    } catch (Exception $e) {
        echo "Erro ao criar operador: " . $e->getMessage() . "\n";
    }
} else {
    // Mostrar o primeiro operador
    $operador = Operador_user::first();
    echo "Primeiro operador encontrado:\n";
    echo "Nome: " . $operador->nome . "\n";
    echo "CPF: " . $operador->cpf . "\n";
}
