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
        Schema::create('pgs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_institution')->constrained('institutions');
            $table->string('nome');
            $table->string('sigla');
            $table->string('imagem');
            $table->integer('ord');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pgs');
    }
};
