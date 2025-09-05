<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $table->id();
        // $table->string('nome');
        // $table->string('nomeguerra');
        // $table->string('identidade');
        // $table->string('email')->unique();
        // $table->string('cpf')->unique();
        // $table->timestamp('email_verified_at')->nullable();
        // $table->string('password');
        // $table->foreignId('id_om')->constrained('oms');
        // $table->foreignId('id_pg')->constrained('pgs');
        if(DB::table('operador_users')->count() == 0){
            DB::table('operador_users')->insert([
                [
                    'id' => '1',
                    'nome' => 'Administrador',
                    'nomeguerra' => 'Admin',
                    'identidade' => '000000000-0',
                    'email' => 'admin@7rm.eb.mil.br',
                    'cpf' => '55555555555',
                    'password' => bcrypt('admin@123'),
                    'id_om' => '2',
                    'id_pg' => 1,
                    'img' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);
            
        } else { 
            echo "\e[31mTable is not empty, therefore NOT "; 
        }
    }
}
