<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
            'dpi' => '123456789',
            'password' => Hash::make('admin123'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);

        $rol = Role::create([
            'name' => 'Administrador',
        ]);

        $user->assignRole($rol);

    }
}
