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
            'kategori' => 'Perhiasan'
        ]);
        $model->save([
            'kategori' => 'Berkas/Surat Berharga'
        ]);
        $model->save([
            'kategori' => 'Kendaraan'
        ]);
    }
}
