<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::insert([
            [
                'nama' => 'Makanan',
                'deskripsi' => 'Kategori makanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Minuman',
                'deskripsi' => 'Kategori minuman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Snack',
                'deskripsi' => 'Kategori snack',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}