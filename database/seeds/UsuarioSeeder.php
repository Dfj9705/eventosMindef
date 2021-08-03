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
            'name' => 'ADMIN',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);

    }
}
