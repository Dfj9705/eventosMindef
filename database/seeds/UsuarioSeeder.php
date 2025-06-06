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
            'dpi' => '00000000000000000',
            'entidad' => 'MDN',
            'password' => Hash::make('admin123'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);

        $rol = Role::create([
            'name' => 'Administrador',
        ]);

        $rol2 = Role::create([
            'name' => 'Digitalizador',
        ]);

        $user->assignRole($rol);

    }
}
