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
        Schema::create('credenciamentos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_pipeiro')->nullable();
            $table->bigInteger('id_empresa')->nullable();
            $table->bigInteger('id_veiculo')->nullable();
            $table->bigInteger('id_edital')->nullable();
            $table->bigInteger('id_processo')->nullable();
            $table->integer('status')->nullable();
            $table->string('doc_reqcred')->nullable();
            $table->string('doc_cico')->nullable();
            $table->string('doc_cicips')->nullable();
            $table->string('doc_cqe')->nullable();
            $table->string('doc_cqsm')->nullable();
            $table->string('doc_sicaf')->nullable();
            $table->string('doc_ciscc')->nullable();
            $table->string('doc_ciem')->nullable();
            $table->string('doc_cndf')->nullable();
            $table->string('doc_cnde')->nullable();
            $table->string('doc_cndm')->nullable();
            $table->string('doc_cidt')->nullable();
            $table->string('doc_antt')->nullable();
            $table->string('doc_lvs')->nullable();
            $table->string('doc_act')->nullable();
            $table->string('doc_cl')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credenciamentos');
    }
};
