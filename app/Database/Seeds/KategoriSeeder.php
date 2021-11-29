<?php

namespace App\Database\Seeds;

use App\Models\KategoriModel;
use CodeIgniter\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $model = new KategoriModel();
        $model->save([
            'kategori' => 'Agama dan filsafat'
        ]);
        $model->save([
            'kategori' => 'Buku Anak'
        ]);
        $model->save([
            'kategori' => 'Kesehatan'
        ]);
        $model->save([
            'kategori' => 'Komik'
        ]);
        $model->save([
            'kategori' => 'Pelajaran'
        ]);
    }
}
