<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\StatusPembayaranModel;

class LaporanController extends BaseController
{
    public function __construct()
    {
        $this->StatusPembayaranModel = new StatusPembayaranModel();
    }
    public function index()
    {
        return view('admin/laporan/index', [
            'title' => 'Laporan',
            'laporans' => $this->StatusPembayaranModel->getLaporan()->paginate(10),
            'pager' => $this->StatusPembayaranModel->pager
        ]);
    }
}
