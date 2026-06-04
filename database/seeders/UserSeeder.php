<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::insert([
            [
                'nama' => 'pemilik',
                'email' => 'pemilik@gmail.com',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Contoh Alamat No. 123, Kota Contoh',
                'role' => 'pemilik',
                'password' => Hash::make('pemilik123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kasir',
                'email' => 'kasir@gmail.com',
                'no_hp' => '089876543210',
                'alamat' => 'Bantul',
                'role' => 'kasir',
                'password' => Hash::make('kasir123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
