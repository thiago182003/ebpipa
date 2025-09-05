<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if(DB::table('municipios')->count() == 0){
            DB::table('municipios')->insert([
                ['id' => '1','id_estado' => 1,'id_om' => 2,'nome' => 'AFOGADOS DA INGAZEIRA','ibge' => '2600104','status' => 1,'datainicio' => date('2023-01-03'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '2','id_estado' => 1,'id_om' => 2,'nome' => 'ALTINHO','ibge' => '2600807','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '3','id_estado' => 2,'id_om' => 2,'nome' => 'AMPARO','ibge' => '2500734','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '4','id_estado' => 1,'id_om' => 2,'nome' => 'ARCOVERDE','ibge' => '2601201','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '5','id_estado' => 2,'id_om' => 2,'nome' => 'AROEIRAS','ibge' => '2501302','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '6','id_estado' => 1,'id_om' => 2,'nome' => 'BEZERROS ','ibge' => '2601904','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '7','id_estado' => 1,'id_om' => 2,'nome' => 'BOM JARDIM','ibge' => '2602209','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '8','id_estado' => 1,'id_om' => 2,'nome' => 'BREJINHO','ibge' => '2602506','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '9','id_estado' => 1,'id_om' => 2,'nome' => 'BREJO DA MADRE DE DEUS','ibge' => '2602605','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '10','id_estado' => 1,'id_om' => 2,'nome' => 'CACHOEIRINHA','ibge' => '2603108','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '11','id_estado' => 1,'id_om' => 2,'nome' => 'CALCADOS','ibge' => '2603306','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '12','id_estado' => 2,'id_om' => 2,'nome' => 'CAMALAU','ibge' => '2503902','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '13','id_estado' => 2,'id_om' => 2,'nome' => 'CARAUBAS','ibge' => '2504074','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '14','id_estado' => 1,'id_om' => 2,'nome' => 'CARUARU','ibge' => '2604106','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '15','id_estado' => 1,'id_om' => 2,'nome' => 'CASINHAS','ibge' => '2604155','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '16','id_estado' => 2,'id_om' => 2,'nome' => 'CONGO','ibge' => '2504702','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '17','id_estado' => 1,'id_om' => 2,'nome' => 'CUMARU','ibge' => '2604908','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '18','id_estado' => 1,'id_om' => 2,'nome' => 'FLORES','ibge' => '2605608','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '19','id_estado' => 1,'id_om' => 2,'nome' => 'FREI MIGUELINHO','ibge' => '2605806','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '20','id_estado' => 2,'id_om' => 2,'nome' => 'GADO BRAVO','ibge' => '2506251','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '21','id_estado' => 1,'id_om' => 2,'nome' => 'GRAVATA','ibge' => '2606408','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '22','id_estado' => 1,'id_om' => 2,'nome' => 'ITAPETIM','ibge' => '2607703','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '23','id_estado' => 1,'id_om' => 2,'nome' => 'JATAUBA','ibge' => '2608008','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '24','id_estado' => 1,'id_om' => 2,'nome' => 'JUREMA','ibge' => '2608404','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '25','id_estado' => 1,'id_om' => 2,'nome' => 'LAJEDO','ibge' => '2607703','status' => 2,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '26','id_estado' => 1,'id_om' => 2,'nome' => 'LIMOEIRO','ibge' => '2608909','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '27','id_estado' => 2,'id_om' => 2,'nome' => 'MONTEIRO','ibge' => '2509701','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '28','id_estado' => 2,'id_om' => 2,'nome' => 'NATUBA','ibge' => '2509909','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '29','id_estado' => 1,'id_om' => 2,'nome' => 'OROBO','ibge' => '2609709','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '30','id_estado' => 2,'id_om' => 2,'nome' => 'OURO VELHO','ibge' => '2510800','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '31','id_estado' => 1,'id_om' => 2,'nome' => 'PESQUEIRA','ibge' => '2610905','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '32','id_estado' => 1,'id_om' => 2,'nome' => 'POMBOS','ibge' => '2214709','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '33','id_estado' => 2,'id_om' => 2,'nome' => 'PRATA','ibge' => '2512200','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '34','id_estado' => 1,'id_om' => 2,'nome' => 'RIACHO DAS ALMAS','ibge' => '2611705','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '35','id_estado' => 1,'id_om' => 2,'nome' => 'SAIRE','ibge' => '2612000','status' => 2,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '36','id_estado' => 2,'id_om' => 2,'nome' => 'SALGADO DE SAO FELIX','ibge' => '2513109','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '37','id_estado' => 2,'id_om' => 2,'nome' => 'SANTA CECILIA','ibge' => '2513158','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '38','id_estado' => 1,'id_om' => 2,'nome' => 'SANTA MARIA DO CAMBUCA','ibge' => '2513159','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '39','id_estado' => 1,'id_om' => 2,'nome' => 'SAO CAETANO','ibge' => '2513160','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '40','id_estado' => 2,'id_om' => 2,'nome' => 'SAO JOAO DO TIGRE','ibge' => '2513161','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '41','id_estado' => 2,'id_om' => 2,'nome' => 'SAO SEBASTIAO DO UMBUZEIRO','ibge' => '2513162','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '42','id_estado' => 1,'id_om' => 2,'nome' => 'SERRA TALHADA','ibge' => '2513163','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '43','id_estado' => 1,'id_om' => 2,'nome' => 'SOLIDAO','ibge' => '2513164','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '44','id_estado' => 2,'id_om' => 2,'nome' => 'SUME','ibge' => '2513165','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '45','id_estado' => 1,'id_om' => 2,'nome' => 'SURUBIM','ibge' => '2513166','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '46','id_estado' => 1,'id_om' => 2,'nome' => 'TACAIMBO','ibge' => '2513167','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '47','id_estado' => 1,'id_om' => 2,'nome' => 'TAQUARITINGA DO NORTE','ibge' => '2513168','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '48','id_estado' => 1,'id_om' => 2,'nome' => 'TORITAMA','ibge' => '2513169','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '49','id_estado' => 1,'id_om' => 2,'nome' => 'TUPARETAMA','ibge' => '2513170','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '50','id_estado' => 2,'id_om' => 2,'nome' => 'UMBUZEIRO','ibge' => '2513171','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '51','id_estado' => 1,'id_om' => 2,'nome' => 'VERTENTE DO LERIO','ibge' => '2513172','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '52','id_estado' => 1,'id_om' => 2,'nome' => 'VERTENTES','ibge' => '2513173','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
                ['id' => '53','id_estado' => 2,'id_om' => 2,'nome' => 'ZABELE','ibge' => '2513174','status' => 1,'datainicio' => date('Y-m-d H:i:s'),'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')],
            ]);
            
        } else { 
            echo "\e[31mTable is not empty, therefore NOT "; 
        }
    }
}
