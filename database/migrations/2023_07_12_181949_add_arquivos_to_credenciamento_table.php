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
        Schema::table('credenciamentos', function (Blueprint $table) {
            //
            $table->string('doc_drctvc')->nullable();
            $table->string('doc_drctvc_status')->nullable();
            $table->string('doc_drctvc_obs')->nullable();

            $table->string('doc_maed')->nullable();
            $table->string('doc_maed_status')->nullable();
            $table->string('doc_maed_obs')->nullable();

            $table->string('doc_cnis')->nullable();
            $table->string('doc_cnis_status')->nullable();
            $table->string('doc_cnis_obs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('credenciamentos', function (Blueprint $table) {
            //
            $table->dropColumn('doc_drctvc');
            $table->dropColumn('doc_drctvc_status');
            $table->dropColumn('doc_drctvc_obs');
            $table->dropColumn('doc_maed');
            $table->dropColumn('doc_maed_status');
            $table->dropColumn('doc_maed_obs');
            $table->dropColumn('doc_cnis');
            $table->dropColumn('doc_cnis_status');
            $table->dropColumn('doc_cnis_obs');
        });
    }
};
