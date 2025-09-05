<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        if(DB::table('oms')->count() == 0){
            DB::table('oms')->insert([
                [
                    'id' => '1',
                    'nome' => 'Comando Militar do Nordeste',
                    'sigla' => 'CMNE',
                    'denominacao' => '',
                    'imagem' => '',
                    'id_om' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '2',
                    'nome' => '7ª Região Militar',
                    'sigla' => '7ª RM',
                    'denominacao' => 'Região Matias de Albuquerque',
                    'imagem' => '',
                    'id_om' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '3',
                    'nome' => 'Base Administrativa do Curado',
                    'sigla' => 'B ADM CURADO',
                    'denominacao' => 'Base Mestre de Campo Antonio Curado Vidal',
                    'imagem' => '',
                    'id_om' => 2,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
            
        } else { 
            echo "\e[31mTable is not empty, therefore NOT "; 
        }
    }
}
