<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Administrator
        User::updateOrCreate(
            ['email' => 'admin@ruangtumbuh.com'],
            [
                'name' => 'Administrator Ruang Tumbuh',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // 2. Akun Contoh Konseli (Siswa)
        User::updateOrCreate(
            ['email' => 'konseli@ruangtumbuh.com'],
            [
                'name' => 'Andi Wijaya',
                'username' => 'andi.wijaya',
                'gender' => 'Laki-laki',
                'grade_class' => 'XI IPA 1',
                'school_origin' => 'SMA Lab UM Malang',
                'password' => Hash::make('password'),
                'role' => 'konseli',
            ]
        );
    }
}
