<?php

namespace App\Database\Seeds;

use App\Models\IklanModel;
use CodeIgniter\Database\Seeder;

class IklanSeeder extends Seeder
{
    public function run()
    {
        $model = new IklanModel();
        $model->save([
            'user_id' => '2',
            'kategori_id' => '1',
            'judul' => 'Kehilangan dompet',
            'lokasi' => 'Jl. Raya Cikampek No.1',
            'deskripsi' => 'Kehilangan dompet',
            'gambar' => 'default.png'
        ]);
        $model->save([
            'user_id' => '2',
            'kategori_id' => '1',
            'judul' => 'Kehilangan Motor',
            'lokasi' => 'Jl. Raya Cikampek No.1',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
            'gambar' => 'default.png'
        ]);
        $model->save([
            'user_id' => '3',
            'kategori_id' => '2',
            'judul' => 'Kehilangan Mobil',
            'lokasi' => 'Jl. Raya Cikampek No.1',
            'deskripsi' => 'Kehilangan dompet',
            'gambar' => 'default.png'
        ]);
    }
}
