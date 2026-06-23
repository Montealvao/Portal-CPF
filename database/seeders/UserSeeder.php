<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('123456'),
                'perfil' => 'admin'
            ]
        );

        User::updateOrCreate(
            ['email' => 'consultante@consultante.com'],
            [
                'name' => 'Consultante',
                'password' => Hash::make('123456'),
                'perfil' => 'consultante'
            ]
        );
    }
}
