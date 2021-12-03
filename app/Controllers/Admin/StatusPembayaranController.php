<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\StatusPembayaranEntity;
use App\Models\StatusPembayaranModel;

class StatusPembayaranController extends BaseController
{
    public function __construct()
    {
        $this->StatusPembayaranModel = new StatusPembayaranModel();
        $this->StatusPembayaranEntity = new StatusPembayaranEntity();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        // return view('admin/pemesanan/index', [
        //     'title' => 'Pemesanan',
        //     'pemesanans' => $this->PemesananModel->get($this->request->getGet('search'))->paginate(10),
        //     'pager' => $this->PemesananModel->pager,
        // ]);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        // return view('admin/pemesanan/show', [
        //     'title' => getAppName(),
        //     'pemesanan' => $this->PemesananModel->getByID($id)->first(),
        //     'detail_pemesanans' => $this->DetailPemesananModel->get($id)->find(),
        // ]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        if ($this->validation->run($this->request->getPost(), 'createStatusPembayaran')) {
            $this->StatusPembayaranEntity->fill($this->request->getPost());
            $pemesanan = $this->StatusPembayaranModel->getByPemesanan($this->request->getPost('pemesanan_id'))->first();
            if ($pemesanan) {
                $this->StatusPembayaranModel->update($pemesanan->id, $this->StatusPembayaranEntity);
            } else {
                $this->StatusPembayaranModel->save($this->StatusPembayaranEntity);
            }
            return redirect()->to('admin/pemesanan');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
