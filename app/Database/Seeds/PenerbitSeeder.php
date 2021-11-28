<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PenerbitSeeder extends Seeder
{
    public function run()
    {
        $model = new \App\Models\PenerbitModel();
        $model->save(['penerbit' => 'Flashbooks']);
        $model->save(['penerbit' => 'Indiva Media Kreasi']);
        $model->save(['penerbit' => 'Kanaya Press']);
        $model->save(['penerbit' => 'Romancious']);
        $model->save(['penerbit' => '3L Comic']);
        $model->save(['penerbit' => 'AB Publisher Yogyakarta']);
        $model->save(['penerbit' => 'Abata Press']);
        $model->save(['penerbit' => 'Abdi Pustaka']);
        $model->save(['penerbit' => 'Adhi Sarana Nusantara']);
        $model->save(['penerbit' => 'Adi Bintang']);
        $model->save(['penerbit' => 'Adi Citra Cemerlang']);
        $model->save(['penerbit' => 'Adibintang']);
    }
}
