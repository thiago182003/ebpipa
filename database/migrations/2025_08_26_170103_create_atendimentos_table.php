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
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->id();
            $table->boolean('usuario_autenticado')->default(false);
            $table->string('user_type')->nullable(); // pipeiro, empresa, operador
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('tipo_requerente')->nullable(); // PIPEIRO, COMPDEC, APONTADOR, etc.
            $table->string('outro_especificar')->nullable();
            $table->string('estado', 2); // AL, PE
            $table->string('municipio');
            $table->text('relato');
            $table->string('status')->default('pendente'); // pendente, em_analise, resolvido
            $table->text('resposta')->nullable();
            $table->timestamp('data_resposta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atendimentos');
    }
};
