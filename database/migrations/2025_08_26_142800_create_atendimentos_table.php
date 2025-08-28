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
        if (!Schema::hasTable('atendimentos')) {
            Schema::create('atendimentos', function (Blueprint $table) {
            $table->id();
            $table->boolean('usuario_autenticado')->default(false);
            $table->string('user_type')->nullable(); // pipeiro, empresa, operador
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('tipo_requerente')->nullable(); // PIPEIRO, COMPDEC, APONTADOR, etc.
            $table->string('outro_especificar')->nullable();
            $table->string('estado', 2);
            $table->string('municipio');
            $table->text('relato');
            $table->enum('status', ['pendente', 'em_andamento', 'resolvido', 'cancelado'])->default('pendente');
            $table->text('resposta')->nullable();
            $table->timestamp('respondido_em')->nullable();
            $table->unsignedBigInteger('respondido_por')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index(['usuario_autenticado', 'status']);
            $table->index(['estado', 'municipio']);
            $table->index('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atendimentos');
    }
};
