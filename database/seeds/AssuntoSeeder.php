<?php

use Illuminate\Database\Seeder;

class AssuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('assuntos')->insert([
            ['id' => 1, 'titulo' => 'Matematica',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 4, 'status'=> 1],
            ['id' => 2, 'titulo' => 'Fisica',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 4, 'status'=> 1],
            ['id' => 3, 'titulo' => 'Historia', 'created_at' => date( 'Y-m-d H:i:s' ),  'idAreaDeConhecimento' => 1, 'status'=> 1],
            ['id' => 4, 'titulo' => 'Geografia', 'created_at' => date( 'Y-m-d H:i:s' ),  'idAreaDeConhecimento' => 1, 'status'=> 1],
            ['id' => 5, 'titulo' => 'Quimica',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 4, 'status'=> 1],
            ['id' => 6, 'titulo' => 'Filosofia', 'created_at' => date( 'Y-m-d H:i:s' ),  'idAreaDeConhecimento' => 1, 'status'=> 1],
            ['id' => 7, 'titulo' => 'Sociologia', 'created_at' => date( 'Y-m-d H:i:s' ),  'idAreaDeConhecimento' => 1, 'status'=> 1],
            ['id' => 8, 'titulo' => 'Biológia',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 2, 'status'=> 1],
            ['id' => 9, 'titulo' => 'Inglês',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 3, 'status'=> 1],
            ['id' => 10, 'titulo' => 'Português',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 3, 'status'=> 1],
            ['id' => 11, 'titulo' => 'Francês',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 3, 'status'=> 1],
            ['id' => 12, 'titulo' => 'Espanhol',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 3, 'status'=> 1],
            ['id' => 13, 'titulo' => 'Alemão',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 3, 'status'=> 1],
            ['id' => 14, 'titulo' => 'Desenho Digital',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 5, 'status'=> 1],
            ['id' => 15, 'titulo' => 'Desenho Tradicional',  'created_at' => date( 'Y-m-d H:i:s' ),  'idAreaDeConhecimento' => 5, 'status'=> 1],
            ['id' => 16, 'titulo' => 'Pintura',  'created_at' => date( 'Y-m-d H:i:s' ),  'idAreaDeConhecimento' => 5, 'status'=> 1],
            ['id' => 17, 'titulo' => 'Aquarela',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 5, 'status'=> 1],
            ['id' => 18, 'titulo' => 'Cartoon',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 5, 'status'=> 1],
            ['id' => 19, 'titulo' => 'Realismo',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 5, 'status'=> 1],
            ['id' => 20, 'titulo' => 'Programação Web Full Stack',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 6, 'status'=> 1],
            ['id' => 21, 'titulo' => 'Desenvolvimento Front-End',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 6, 'status'=> 1],
            ['id' => 22, 'titulo' => 'Desenvolvimento Back-End', 'created_at' => date( 'Y-m-d H:i:s' ),  'idAreaDeConhecimento' => 6, 'status'=> 1],
            ['id' => 23, 'titulo' => 'Desenvolvimento Back-End',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 6, 'status'=> 1],
            ['id' => 24, 'titulo' => 'Bordado',  'created_at' => date( 'Y-m-d H:i:s' ),  'idAreaDeConhecimento' => 7, 'status'=> 1],
            ['id' => 25, 'titulo' => 'Croche',  'created_at' => date( 'Y-m-d H:i:s' ), 'idAreaDeConhecimento' => 7, 'status'=> 1],
   
        ]);


       


    }
}
