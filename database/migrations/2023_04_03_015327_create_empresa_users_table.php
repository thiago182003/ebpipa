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
        Schema::create('empresa_users', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('razaosocial');
            $table->string('cnpj')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telefone');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->rememberToken();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa_users');
    }
};
