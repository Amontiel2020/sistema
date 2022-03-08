<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \App\Estudante;



class EstudantesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data = array(
        	[

        		'nome' => 'Estudante1',
                'apelido' => 'Apelido', 
                'curso' => 'Test', 

                'email' => 'estudante1@gmail.com',
                'turma_id'=>1,
                'pathImage'=>''

            ],
        	
            [

                'nome' => 'Estudante2',
                'apelido' => 'Apelido',
                'curso' => 'test', 

                'email' => 'estudante2@gmail.com',
                'turma_id'=>1,
                'pathImage'=>''

            ],
            [

                'nome' => 'Estudante3', 
                'apelido' => 'Apelido',
                'curso' => 'test', 

                'email' => 'email',
                'turma_id'=>1,
                'pathImage'=>''

            ],         
            [

                'nome' => 'Estudante4', 
                'apelido' => 'apelido',
                'curso' => 'Test', 

                'email' => 'email',

                 'turma_id'=>1,
                 'pathImage'=>''

            ],
            [

                'nome' => 'Estudante5', 
                'apelido' => 'Apelido',
                'curso' => 'Curso',
                'email' => 'email',

                 'turma_id'=>1,
                'pathImage'=>''

            ]
        );

        Estudante::insert($data);
    }
}