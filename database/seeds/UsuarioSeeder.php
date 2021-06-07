<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Daniel',
            'email' => 'correo@correo.com',
            'password' => Hash::make('123456789'),
        ]);



        $user2 = User::create([
            'name' => 'Abner',
            'email' => 'correo2@correo.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}
