<?php

use Illuminate\Database\Seeder;
use cactu\User;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::where('email','svilcacundo@cactu.org.ec')->first();
        if(!$user){
            $user= User::Create([
                'name' => 'Santiago',
                'email' => 'svilcacundo@cactu.org.ec',
                'password' => Hash::make('12345678'),
                'email_verified_at'=>'2019-07-16 00:00:00'
            ]);
        }
        $user->assignRole('Administrador');
        $user->assignRole('Gestor');
    }
}
