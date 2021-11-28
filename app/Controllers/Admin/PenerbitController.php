<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\KategoriEntity;
use App\Models\PenerbitModel;

class PenerbitController extends BaseController
{
    public function __construct()
    {
        $this->PenerbitModel = new PenerbitModel();
        $this->KategoriEntity = new KategoriEntity();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('admin/penerbit/index', [
            'title' => 'Penerbit',
            'penerbits' => $this->PenerbitModel->get($this->request->getGet('search'))->paginate(10),
            'pager' => $this->PenerbitModel->pager
        ]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('admin/penerbit/_form', [
            'title' => 'Penerbit',
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
        if ($this->validation->run($this->request->getPost(), 'createPenerbit')) {
            $this->KategoriEntity->fill($this->request->getPost());
            $this->PenerbitModel->save($this->KategoriEntity);
            return redirect('admin/penerbit')->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
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
        $penerbit = $this->PenerbitModel->find($id);
        if (!$penerbit) {
            return redirect()->to('admin/user')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        return view('admin/penerbit/_form', [
            'title' => 'Penerbit',
            'validation' => $this->validation,
            'penerbit' => $penerbit
        ]);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $penerbit = $this->PenerbitModel->find($id);
        if (!$penerbit) {
            return redirect()->to('admin/penerbit')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        if ($this->validation->run($this->request->getPost(), 'updatePenerbit')) {
            $this->KategoriEntity->fill($this->request->getPost());
            $this->PenerbitModel->save($this->KategoriEntity);
            return redirect('admin/penerbit')->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
        } else {
            return redirect()->to('admin/penerbit/' . $id . '/edit')->withInput()->with('validation', $this->validation->getErrors());
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $penerbit = $this->PenerbitModel->find($id);
        if (!$penerbit) {
            return redirect()->to('admin/penerbit')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        $this->PenerbitModel->delete($id);
        return redirect()->back()->with('delete_success', alert('success', 'Data berhasil dihapus', 'Berhasil'));
    }
}
