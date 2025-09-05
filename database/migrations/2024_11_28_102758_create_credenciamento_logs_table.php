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
        Schema::create('credenciamento_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credenciamento_id');
            $table->string('status_antigo')->nullable();
            $table->string('status_novo');
            $table->unsignedBigInteger('alterado_por_id'); // ID do operador ou usuário
            $table->string('alterado_por_tipo'); // 'operador' ou 'usuario'
            $table->timestamp('data_alteracao');
            $table->foreign('credenciamento_id')->references('id')->on('credenciamentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credenciamento_logs');
    }
};
