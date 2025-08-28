<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Atendimento;
use App\Models\AtendimentoAnexo;

$at = Atendimento::create([
    'usuario_autenticado' => false,
    'estado' => 'AL',
    'municipio' => 'TESTE',
    'relato' => 'Teste script',
]);

$anexo = AtendimentoAnexo::create([
    'atendimento_id' => $at->id,
    'path' => 'atendimentos/'.$at->id.'/dummy.pdf',
    'original_name' => 'dummy.pdf',
    'mime' => 'application/pdf',
    'size' => 1234,
]);

echo "OK: at={$at->id}, anexo={$anexo->id}\n";
