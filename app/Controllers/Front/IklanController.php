<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\IklanModel;

class IklanController extends BaseController
{
    public function __construct()
    {
        $this->IklanModel = new IklanModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index($kategori = null)
    {
        $iklans = $kategori ?
            $this->IklanModel->getByKategori($kategori, $this->request->getGet('search'))
            : $this->IklanModel->get($this->request->getGet('search'));
        return view('front/iklan/index', [
            'iklans' => $iklans->paginate(12),
            'pager' => $this->IklanModel->pager,
            'title' => getAppName()
        ]);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        return view('front/iklan/show', [
            'iklan' => $this->IklanModel->getByID($id)->first(),
            'title' => getAppName()
        ]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
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
