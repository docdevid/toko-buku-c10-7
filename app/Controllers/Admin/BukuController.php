<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\BukuEntity;
use App\Models\BukuModel;

class BukuController extends BaseController
{
    public function __construct()
    {
        $this->BukuModel = new BukuModel();
        $this->BukuEntity = new BukuEntity();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('admin/buku/index', [
            'bukus' => $this->BukuModel->get($this->request->getGet('search'))->paginate(12),
            'pager' => $this->BukuModel->pager,
            'title' => 'Buku'
        ]);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('admin/buku/_form', [
            'title' => 'Buku',
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
        if ($this->validation->run($this->request->getPost(), 'createBuku')) {
            $gambar = $this->request->getFile('gambar');
            $gambar_name = $gambar->getRandomName();
            $gambar->move('uploads/buku', $gambar_name);
            $this->BukuEntity->gambar = $gambar_name;
            $this->BukuEntity->fill($this->request->getPost());
            $this->BukuModel->save($this->BukuEntity);
            return redirect('admin/buku')->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
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
        $buku = $this->BukuModel->find($id);
        return view('admin/buku/_form', [
            'title'         => 'Buku',
            'validation'    => $this->validation,
            'buku' => $buku
        ]);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $buku = $this->BukuModel->find($id);
        if (!$buku) {
            return redirect()->to('admin/buku')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        if ($this->validation->run($this->request->getPost(), 'updateBuku')) {
            $gambar = $this->request->getFile('gambar');
            $_gambar = $this->request->getPost('_gambar');
            if ($gambar->getError() == 4) {
                $this->BukuEntity->gambar = $_gambar == '' ? 'default.png' : $_gambar;
            } else {
                $gambar_name = $gambar->getRandomName();
                if ($gambar->move('uploads/buku', $gambar_name)) {
                    @unlink(FCPATH . 'uploads/buku/' . $_gambar);
                    $this->BukuEntity->gambar = $gambar_name;
                }
            }
            $this->BukuEntity->fill($this->request->getPost());
            $this->BukuModel->save($this->BukuEntity);
            return redirect('admin/buku')->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
        } else {
            return redirect()->to('admin/buku/' . $id . '/edit')->withInput()->with('validation', $this->validation->getErrors());
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $buku = $this->BukuModel->find($id);
        if (!$buku) {
            return redirect()->to('admin/buku')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        @unlink(FCPATH . 'uploads/buku/' . $buku->gambar);
        $this->BukuModel->delete($id);
        return redirect()->to('admin/buku')->with('delete_success', alert('success', 'Data berhasil dihapus', 'Berhasil'));
    }
}
