<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Karyawan;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        Karyawan::create([
            'nama_karyawan' => 'Admin',
            'email_karyawan' => 'admin@example.com',
            'password_karyawan' => Hash::make('admin123'), // Password sudah di-hash
            'role' => 'admin'
        ]);

        Karyawan::create([
            'nama_karyawan' => 'Karyawan 1',
            'email_karyawan' => 'karyawan1@example.com',
            'password_karyawan' => Hash::make('password123'), // Hash password
            'role' => 'karyawan'
        ]);

    }
}
