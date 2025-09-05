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
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pipeiro')->nullable();
            $table->bigInteger('id_empresa')->nullable();
            $table->string('placa')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('ano')->nullable();
            $table->string('chassi')->nullable();
            $table->string('doc_crlv')->nullable();
            $table->string('doc_lav')->nullable();
            $table->string('veiculo_img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos');
    }
};
