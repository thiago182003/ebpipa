<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstituicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if(DB::table('institutions')->count() == 0){
            DB::table('institutions')->insert([
                [
                    'id' => '1',
                    'nome' => 'Exército',
                    'abrev' => 'EB',
                    'imagem' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '2',
                    'nome' => 'Marinha',
                    'abrev' => 'MB',
                    'imagem' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '3',
                    'nome' => 'Aeronáutica',
                    'abrev' => 'FAB',
                    'imagem' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '4',
                    'nome' => 'Bombeiro',
                    'abrev' => 'CB',
                    'imagem' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '5',
                    'nome' => 'Civil',
                    'abrev' => 'SC',
                    'imagem' => '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ]);
            
        } else { 
            echo "\e[31mTable is not empty, therefore NOT "; 
        }
    }
}
