<?php

use Illuminate\Database\Seeder;

class AreaDeConhecimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('area_de_conhecimentos')->insert([
            ['id' => 1,  'created_at' => date( 'Y-m-d H:i:s' ), 'nomeArea' => 'Humanas'],
            ['id' => 2,  'created_at' => date( 'Y-m-d H:i:s' ), 'nomeArea' => 'Biológicas'],
            ['id' => 3,  'created_at' => date( 'Y-m-d H:i:s' ), 'nomeArea' => 'Linguagens'],
            ['id' => 4,  'created_at' => date( 'Y-m-d H:i:s' ), 'nomeArea' => 'Exatas'],
            ['id' => 5,  'created_at' => date( 'Y-m-d H:i:s' ), 'nomeArea' => 'Artes'],
            ['id' => 6,  'created_at' => date( 'Y-m-d H:i:s' ), 'nomeArea' => 'Tecnologia'],
            ['id' => 7,  'created_at' => date( 'Y-m-d H:i:s' ), 'nomeArea' => 'Lazer'],
   
        ]);
    }
}
