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
        Schema::create('pipeiro_users', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('identidade')->nullable();
            $table->string('identidadeemissor')->nullable();
            $table->string('identidadedata')->nullable();
            $table->string('cpf')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('cnhnumero')->nullable();
            $table->string('cnhcateg')->nullable();
            $table->string('cnhdata')->nullable();
            $table->string('telefone')->nullable();
            $table->string('escolaridade')->nullable();
            $table->string('estadocivil')->nullable();
            $table->string('raca')->nullable();
            $table->string('naturalidade')->nullable();
            $table->string('nacionalidade')->nullable();
            $table->string('img')->nullable();
            $table->string('imgidtfrente')->nullable();
            $table->string('imgidtcosta')->nullable();
            $table->string('cnhfrente')->nullable();
            $table->string('cnhcosta')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pipeiro_users');
    }
};
