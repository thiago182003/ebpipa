<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EditalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
            
            public function run()
            {
                
                if(DB::table('editals')->count() == 0){
                    DB::table('editals')->insert([
                        [
                            'id' => '1',
                            'datainicio' => '01/01/2023',
                            'datafim' => '31/12/2023',
                            'nome' => 'Edital 2023',
                            'documento' => '',
                            'status' => 1,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]
                    ]);
                    
                } else { 
                    echo "\e[31mTable is not empty, therefore NOT "; 
                }
        
            }
}
