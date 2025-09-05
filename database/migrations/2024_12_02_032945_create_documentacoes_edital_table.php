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
        Schema::create('documentacoes_edital', function (Blueprint $table) {
            $table->id();
            $table->foreignId('edital_id')->constrained('editals')->onDelete('cascade');
            $table->foreignId('documentacao_id')->constrained('documentacao')->onDelete('cascade');
            $table->boolean('is_obrigatorio')->default(false); // Opcional para sobrescrever
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentacoes_edital');
    }
};
