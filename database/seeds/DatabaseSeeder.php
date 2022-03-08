<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Model::unguard();
        // $this->call(UsersTableSeeder::class);
         $this->call(EstudantesTableSeeder::class);
         $this->call(TurmasTableSeeder::class);
         $this->call(RoleTableSeeder::class);      
         $this->call(UserTableSeeder::class);

        Model::reguard();


    }
}
