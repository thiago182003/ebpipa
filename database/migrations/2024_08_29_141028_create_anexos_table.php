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
        Schema::create('anexos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_om')->constrained('oms');
            $table->string('requerimento_credenciamento')->nullable();
            $table->string('conhecimento_das_informacoes')->nullable();
            $table->string('condicao_do_veiculo')->nullable();
            $table->string('exposicao_dados')->nullable();
            $table->string('trabalho_de_menor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anexos');
    }
};
