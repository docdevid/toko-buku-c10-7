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
            'bukus' => $this->BukuModel->get()->paginate(10),
            'pager' => $this->BukuModel->pager,
            'title' => getAppName()
        ]);
    }
}
