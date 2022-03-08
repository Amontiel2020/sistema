<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \App\Turma;



class TurmasTableSeeder extends Seeder
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

        		'identificador' => 'Turma A', 
                 'curso'=>'Ciencias da Computacao',
                 'periodo'=>'Noite'
            ],
            [

                'identificador' => 'Turma B', 
                 'curso'=>'Ciencias da Computacao',
                 'periodo'=>'Noite'
            ]      	
 
        );

        Turma::insert($data);
    }
}