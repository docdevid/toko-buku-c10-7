<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\KategoriEntity;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    public function __construct()
    {
        $this->KategoriModel = new KategoriModel();
        $this->KategoriEntity = new KategoriEntity();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('admin/kategori/index', [
            'title' => 'Kategori',
            'kategoris' => $this->KategoriModel->get($this->request->getGet('search'))->paginate(10),
            'pager' => $this->KategoriModel->pager
        ]);
    }


    public function indexByJenisUsaha($jenisUsaha)
    {
        return view('admin/kategori/index', [
            'title' => 'Kategori',
            'slug' => ucwords(str_replace('-', ' ', $jenisUsaha)),
            'kategoris' => $this->KategoriModel->getByJenisUsaha($jenisUsaha)->paginate(10),
            'pager' => $this->KategoriModel->pager
        ]);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        return view('admin/kategori/show', [
            'title' => 'Kategori',
            'amalUsaha' => $this->KategoriModel->getByID($id)->first()
        ]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('admin/kategori/_form', [
            'title' => 'Kategori',
            'validation' => $this->validation
        ]);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        if ($this->validation->run($this->request->getPost(), 'createKategori')) {
            $this->KategoriEntity->fill($this->request->getPost());
            $this->KategoriModel->save($this->KategoriEntity);
            return redirect('admin/kategori')->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
        } else {
            return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $kategori = $this->KategoriModel->find($id);
        if (!$kategori) {
            return redirect()->to('admin/user')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        return view('admin/kategori/_form', [
            'title' => 'Kategori',
            'validation' => $this->validation,
            'kategori' => $kategori
        ]);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $kategori = $this->KategoriModel->find($id);
        if (!$kategori) {
            return redirect()->to('admin/kategori')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        if ($this->validation->run($this->request->getPost(), 'updateKategori')) {
            $this->KategoriEntity->fill($this->request->getPost());
            $this->KategoriModel->save($this->KategoriEntity);
            return redirect('admin/kategori')->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
        } else {
            return redirect()->to('admin/kategori/' . $id . '/edit')->withInput()->with('validation', $this->validation->getErrors());
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $kategori = $this->KategoriModel->find($id);
        if (!$kategori) {
            return redirect()->to('admin/kategori')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        $this->KategoriModel->delete($id);
        return redirect()->back()->with('delete_success', alert('success', 'Data berhasil dihapus', 'Berhasil'));
    }
}
