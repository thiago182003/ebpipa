<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcessoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if(DB::table('processos')->count() == 0){
            DB::table('processos')->insert([
                [
                    'id' => '1',
                    'id_edital' => 1,
                    'periodo' => '1° Quadrimestre',
                    'ano' => 'Edital 2023',
                    'status' => 2,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '2',
                    'id_edital' => 1,
                    'periodo' => '2° Quadrimestre',
                    'ano' => 'Edital 2023',
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '3',
                    'id_edital' => 1,
                    'periodo' => '3° Quadrimestre',
                    'ano' => 'Edital 2023',
                    'status' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);
            
        } else { 
            echo "\e[31mTable is not empty, therefore NOT "; 
        }
    }
    // $table->id();
    // $table->foreignId('id_edital');
    // $table->string('periodo');
    // $table->string('ano');
    // $table->Integer('status');
}
