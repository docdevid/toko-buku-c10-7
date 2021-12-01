<?php

namespace App\Database\Seeds;

use App\Models\BukuModel;
use CodeIgniter\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run()
    {
        $model = new BukuModel();
        $model->save(
            [
                'penerbit_id' => 1,
                'kategori_id' => 1,
                'judul' => 'Matematika',
                'penulis' => 'Penulis 1',
                'berat' => '1',
                'dimensi' => '1',
                'bahasa' => '1',
                'cover' => '1',
                'ISBN' => '1',
                'deskripsi' => '1',
                'harga' => 25000,
                'gambar' => 'default.png',
            ]
        );
        $model->save(
            [
                'penerbit_id' => 1,
                'kategori_id' => 1,
                'judul' => 'Fisika',
                'penulis' => 'Penulis 1',
                'berat' => '1',
                'dimensi' => '1',
                'bahasa' => '1',
                'cover' => '1',
                'ISBN' => '1',
                'deskripsi' => '1',
                'harga' => 20000,
                'gambar' => 'default.png',
            ]
        );
        $model->save(
            [
                'penerbit_id' => 1,
                'kategori_id' => 1,
                'judul' => 'Bahasa Inggri',
                'penulis' => 'Penulis 1',
                'berat' => '1',
                'dimensi' => '1',
                'bahasa' => '1',
                'cover' => '1',
                'ISBN' => '1',
                'deskripsi' => '1',
                'harga' => 15000,
                'gambar' => 'default.png',
            ]
        );
    }
}
