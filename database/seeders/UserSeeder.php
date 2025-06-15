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
                'id' => '03102003',
                'nama' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'jenis_kelamin' => 'laki-laki',
                'alamat' => 'Jalan Raya Cikarang',
                'no_hp' => '08123456789',
                'role' => 'admin'
            ],
            [
                'id' => '03102004',
                'nama' => 'Karyawan',
                'email' => 'karyawan@gmail.com',
                'password' => Hash::make('karyawan123'),
                'jenis_kelamin' => 'laki-laki',
                'alamat' => 'Jalan Raya Cikarang',
                'no_hp' => '08123456789',
                'role' => 'karyawan'
            ]
        ]);
    }
}
