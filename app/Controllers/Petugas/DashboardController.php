<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\AmalUsahaModel;
use App\Models\JenisUsahaModel;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function __construct()
    {
        $this->amalUsahaModel = new AmalUsahaModel();
        $this->jenisUsahaModel = new JenisUsahaModel();
        $this->userModel = new UserModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('petugas/dashboard/index', [
            'session' => $this->session,
            'title' => 'Dashboard',
            'count_amal_usaha' => $this->amalUsahaModel->get()->countAllResults(),
            'count_jenis_usaha' => $this->jenisUsahaModel->get()->countAllResults(),
            'count_user' => $this->userModel->get()->countAllResults(),
        ]);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
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
        //
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
