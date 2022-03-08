<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                $role_user = Role::where('name', 'user')->first();        
                $role_admin = Role::where('name', 'admin')->first();
                $role_gestor = Role::where('name', 'gestor')->first();        

                //User
                $user = new User();        
                $user->name = 'User';        
                $user->email = 'user@example.com';        
                $user->password = bcrypt('secret');        
                $user->save();        
                $user->roles()->attach($role_user);

                //Admin        
                $user = new User();        
                $user->name = 'Admin';        
                $user->email = 'admin@example.com';        
                $user->password = bcrypt('secret');        
                $user->save();        
                $user->roles()->attach($role_admin);

                //Gestor
                $user = new User();        
                $user->name = 'Gestor';        
                $user->email = 'gestor@example.com';        
                $user->password = bcrypt('secret');        
                $user->save();        
                $user->roles()->attach($role_gestor);
    }
}
