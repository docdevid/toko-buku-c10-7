<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\BukuModel;

class BukuController extends BaseController
{
    public function __construct()
    {
        $this->BukuModel = new BukuModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index($search_by = null, $search_id = null)
    {
        // dd($kategori, $kategori_id);

        if ($search_by == 'kategori') {
            $buku = $this->BukuModel->getByKategori($search_id, $this->request->getGet('search'));
        } else {
            $buku = $this->BukuModel->get($this->request->getGet('search'));
        }
        return view('front/buku/index', [
            'title' => getAppName(),
            'bukus' => $buku->paginate(10),
            'pager' => $this->BukuModel->pager
        ]);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        return view('front/buku/show', [
            'title' => getAppName(),
            'buku' => $this->BukuModel->getByID($id)->first()
        ]);
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
