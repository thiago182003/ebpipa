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
        Schema::table('veiculos', function (Blueprint $table) {
            //
            $table->integer('proprio')->nullable();
            $table->string('doc_cl')->nullable();
            $table->string('doc_cl_status')->nullable();
            $table->string('doc_cl_obs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('veiculos', function (Blueprint $table) {
            //
            $table->dropColumn('proprio');
            $table->dropColumn('doc_cl');
            $table->dropColumn('doc_cl_status');
            $table->dropColumn('doc_cl_obs');
        });
    }
};
