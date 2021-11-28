<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\IklanModel;

class HomeController extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->IklanModel = new IklanModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('front/home/index', [
            'iklans' => $this->IklanModel
                ->select('iklan.*,kategori.kategori as kategori,user.nama_lengkap as nama_lengkap')
                ->join('kategori', 'kategori.id = iklan.kategori_id', 'left')
                ->join('user', 'user.id = iklan.user_id', 'left')
                ->orderBy('iklan.id', 'desc')
                ->findAll(4),
            'title' => getAppName()
        ]);
    }
}
