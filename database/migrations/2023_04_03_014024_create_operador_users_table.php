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
        Schema::create('operador_users', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('nomeguerra');
            $table->string('identidade');
            $table->string('email')->unique();
            $table->string('cpf')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('id_om')->constrained('oms');
            $table->foreignId('id_pg')->constrained('pgs');
            $table->string('img')->nullable();
            $table->integer('nivel')->nullable();
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
        Schema::dropIfExists('operador_users');
    }
};
