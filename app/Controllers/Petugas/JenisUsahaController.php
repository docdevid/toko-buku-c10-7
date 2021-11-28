<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Entities\JenisUsahaEntity;
use App\Models\JenisUsahaModel;

class JenisUsahaController extends BaseController
{
    public function __construct()
    {
        $this->jenisUsahaModel = new JenisUsahaModel();
        $this->jenisUsahaEntity = new JenisUsahaEntity();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('petugas/jenis-usaha/index', [
            'title' => 'Jenis Usaha',
            'jenisUsahas' => $this->jenisUsahaModel->get($this->request->getGet('search'))->paginate(10),
            'pager' => $this->jenisUsahaModel->pager
        ]);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $jenisUsaha = $this->jenisUsahaModel->find($id);
        if (!$jenisUsaha) {
            return redirect()->to('pcm/jenis-usaha')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        return view('petugas/jenis-usaha/show', [
            'title' => 'Jenis USaha',
            'jenisUsaha' => $jenisUsaha
        ]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('petugas/jenis-usaha/_form', [
            'title' => 'Jenis Usaha',
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
        if ($this->validation->run($this->request->getPost(), 'createJenisUsaha')) {
            $this->jenisUsahaEntity->slug = $this->request->getPost('nama');
            $this->jenisUsahaEntity->fill($this->request->getPost());
            $this->jenisUsahaModel->save($this->jenisUsahaEntity);
            return redirect('pcm/jenis-usaha')->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
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
        $jenisUsaha = $this->jenisUsahaModel->find($id);
        if (!$jenisUsaha) {
            return redirect()->to('pcm/jenis-usaha')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        return view('petugas/jenis-usaha/_form', [
            'title' => 'Pengguna',
            'validation' => $this->validation,
            'jenisUsaha' => $jenisUsaha
        ]);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $jenisUsaha = $this->jenisUsahaModel->find($id);
        if (!$jenisUsaha) {
            return redirect()->to('pcm/jenis-usaha')->with('get_failed', alert('danger', 'Jenis Usaha tidak ditemukan', 'Error '));
        }
        if ($this->validation->run($this->request->getPost(), 'updateJenisUsaha')) {
            $this->jenisUsahaEntity->fill($this->request->getPost());
            $this->jenisUsahaModel->save($this->jenisUsahaEntity);
            return redirect('pcm/jenis-usaha')->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
        } else {
            return redirect()->to('pcm/jenis-usaha/new')->withInput()->with('validation', $this->validation->getErrors());
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $jenisUsaha = $this->jenisUsahaModel->find($id);
        if (!$jenisUsaha) {
            return redirect()->to('pcm/jenis-usaha')->with('get_failed', alert('danger', 'Jenis usaha tidak ditemukan', 'Error '));
        }
        $this->jenisUsahaModel->delete($id);
        return redirect()->to('pcm/jenis-usaha')->with('delete_success', alert('success', 'Data berhasil dihapus', 'Berhasil'));
    }
}
