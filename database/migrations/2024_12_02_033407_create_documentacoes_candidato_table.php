<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documentacoes_candidato', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('candidato_id'); // ID do candidato
            $table->string('candidato_type'); // Tipo do candidato (PipeiroUsers ou EmpresaUsers)
            $table->foreignId('edital_id')->constrained('editals')->onDelete('cascade'); // Edital
            $table->foreignId('documentacao_id')->constrained('documentacao')->onDelete('cascade'); // Documentação exigida
            $table->string('arquivo')->nullable(); // Caminho do arquivo enviado
            $table->string('status');
            $table->text('observacoes')->nullable(); // Observações adicionais
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentacoes_candidato');
    }
};
