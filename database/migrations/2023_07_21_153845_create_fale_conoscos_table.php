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
        Schema::create('fale_conoscos', function (Blueprint $table) {
            $table->id();
            $table->string('id_user')->nullable();
            $table->string('nome')->nullable();
            $table->string('email')->nullable();
            $table->text('mensagem')->nullable();
            $table->string('imagem')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fale_conoscos');
    }
};
