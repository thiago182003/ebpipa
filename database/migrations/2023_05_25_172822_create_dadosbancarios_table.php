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
        Schema::create('dadosbancarios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pipeiro')->nullable();
            $table->bigInteger('id_empresa')->nullable();
            $table->string('banco')->nullable();
            $table->string('codbanco')->nullable();
            $table->string('agencia')->nullable();
            $table->string('conta')->nullable();
            $table->string('doc_comprovante')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dadosbancarios');
    }
};
