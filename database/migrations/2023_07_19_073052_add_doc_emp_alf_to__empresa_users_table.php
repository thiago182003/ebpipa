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
        Schema::table('Empresa_users', function (Blueprint $table) {
            //
            $table->string('doc_emp_alf');
            $table->string('doc_emp_alf_status');
            $table->string('doc_emp_alf_obs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Empresa_users', function (Blueprint $table) {
            //
            $table->dropColumn('doc_emp_alf');
            $table->dropColumn('doc_emp_alf_status');
            $table->dropColumn('doc_emp_alf_obs');
        });
    }
};
