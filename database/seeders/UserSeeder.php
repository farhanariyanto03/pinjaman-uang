<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'alamat' => 'Jalan Raya Cikarang',
                'no_hp' => '08123456789',
                'role' => 'admin'
            ],
            [
                'nama' => 'Karyawan',
                'email' => 'karyawan@gmail.com',
                'password' => Hash::make('karyawan123'),
                'alamat' => 'Jalan Raya Cikarang',
                'no_hp' => '08123456789',
                'role' => 'karyawan'
            ]
        ]);
    }
}
