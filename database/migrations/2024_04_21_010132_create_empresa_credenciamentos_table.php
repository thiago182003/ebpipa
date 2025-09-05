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
        if (!Schema::hasTable('empresa_credenciamentos')) {
            Schema::create('empresa_credenciamentos', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_empresa')->constrained('pipeiro_users')->nullable();
                $table->foreignId('id_credenciamento')->constrained('credenciamentos')->nullable();
                $table->integer('status');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa_credenciamentos');
    }
};
