<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if(DB::table('pgs')->count() == 0){
            DB::table('pgs')->insert([
                [
                    'id' => '1',
                    'id_institution' => '1',
                    'nome' => 'Marechal',
                    'sigla' => 'Mar',
                    'imagem' => '',
                    'ord' => '1',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '2',
                    'id_institution' => '1',
                    'nome' => 'General de Exercito',
                    'sigla' => 'GEN EXE',
                    'imagem' => '',
                    'ord' => '2',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '3',
                    'id_institution' => '1',
                    'nome' => 'General de Divisão',
                    'sigla' => 'GEN DIV',
                    'imagem' => '',
                    'ord' => '3',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '4',
                    'id_institution' => '1',
                    'nome' => 'General de Brigada',
                    'sigla' => 'GEN BDA',
                    'imagem' => '',
                    'ord' => '4',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '5',
                    'id_institution' => '1',
                    'nome' => 'CORONEL',
                    'sigla' => 'CEL',
                    'imagem' => '',
                    'ord' => '5',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '6',
                    'id_institution' => '1',
                    'nome' => 'Tenente Coronel',
                    'sigla' => 'TC',
                    'imagem' => '',
                    'ord' => '6',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '7',
                    'id_institution' => '1',
                    'nome' => 'Major',
                    'sigla' => 'MAJ',
                    'imagem' => '',
                    'ord' => '7',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '8',
                    'id_institution' => '1',
                    'nome' => 'Capitão',
                    'sigla' => 'CAP',
                    'imagem' => '',
                    'ord' => '8',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '9',
                    'id_institution' => '1',
                    'nome' => '1° Tenente',
                    'sigla' => '1° TEN',
                    'imagem' => '',
                    'ord' => '9',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '10',
                    'id_institution' => '1',
                    'nome' => '2° Tenente',
                    'sigla' => '2° TEN',
                    'imagem' => '',
                    'ord' => '10',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '11',
                    'id_institution' => '1',
                    'nome' => 'Aspirante',
                    'sigla' => 'Asp',
                    'imagem' => '',
                    'ord' => '11',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '12',
                    'id_institution' => '1',
                    'nome' => 'Sub Tenente',
                    'sigla' => 'ST',
                    'imagem' => '',
                    'ord' => '12',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '13',
                    'id_institution' => '1',
                    'nome' => '1° Sargento',
                    'sigla' => '1° SGT',
                    'imagem' => '',
                    'ord' => '13',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '14',
                    'id_institution' => '1',
                    'nome' => '2° Sargento',
                    'sigla' => '2° SGT',
                    'imagem' => '',
                    'ord' => '14',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '15',
                    'id_institution' => '1',
                    'nome' => '3° Sargento',
                    'sigla' => '3° SGT',
                    'imagem' => '',
                    'ord' => '15',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '16',
                    'id_institution' => '1',
                    'nome' => 'Cabo',
                    'sigla' => 'CB',
                    'imagem' => '',
                    'ord' => '16',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '17',
                    'id_institution' => '1',
                    'nome' => 'Soldado Efv Prf',
                    'sigla' => 'SD EP',
                    'imagem' => '',
                    'ord' => '17',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => '18',
                    'id_institution' => '1',
                    'nome' => 'Soldado Efv Vrv',
                    'sigla' => 'SD EV',
                    'imagem' => '',
                    'ord' => '18',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ]);
            
        } else { 
            echo "\e[31mTable is not empty, therefore NOT "; 
        }

    }
}
