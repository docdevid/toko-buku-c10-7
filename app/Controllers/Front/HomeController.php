<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\BukuModel;

class HomeController extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->BukuModel = new BukuModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('front/home/index', [
            'bukus' => $this->BukuModel
                ->select('buku.*,kategori.kategori as kategori')
                ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
                ->join('penerbit', 'penerbit.id = buku.penerbit_id', 'left')
                ->orderBy('buku.id', 'desc')
                ->findAll(4),
            'title' => getAppName()
        ]);
    }
}
