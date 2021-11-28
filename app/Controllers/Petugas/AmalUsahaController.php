<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Entities\AmalUsahaEntity;
use App\Entities\NodeEntity;
use App\Models\AmalUsahaModel;
use App\Models\JenisUsahaModel;
use App\Models\NodeModel;

class AmalUsahaController extends BaseController
{
    public function __construct()
    {
        $this->jenisUSahaModel = new JenisUsahaModel();
        $this->amalUsahaModel = new AmalUsahaModel();
        $this->amalUsahaEntity = new AmalUsahaEntity();
        $this->nodeEntity = new NodeEntity();
        $this->nodeModel = new NodeModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('petugas/amal-usaha/index', [
            'title' => 'Amal Usaha',
            'amalUsahas' => $this->amalUsahaModel->get($this->request->getGet('search'))->paginate(10),
            'pager' => $this->amalUsahaModel->pager
        ]);
    }


    public function indexByJenisUsaha($jenisUsaha)
    {
        return view('petugas/amal-usaha/index', [
            'title' => 'Amal Usaha',
            'slug' => ucwords(str_replace('-', ' ', $jenisUsaha)),
            'amalUsahas' => $this->amalUsahaModel->getByJenisUsaha($jenisUsaha)->paginate(10),
            'pager' => $this->amalUsahaModel->pager
        ]);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        return view('petugas/amal-usaha/show', [
            'title' => 'Amal Usaha',
            'amalUsaha' => $this->amalUsahaModel->getByID($id)->first()
        ]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('petugas/amal-usaha/_form', [
            'title' => 'Amal Usaha',
            'jenisUsahas' => $this->jenisUSahaModel->find(),
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
        if ($this->validation->run($this->request->getPost(), 'createAmalUsaha')) {
            $gambar = $this->request->getFile('gambar');
            $gambar_name = $gambar->getRandomName();
            $gambar->move('upload/object', $gambar_name);

            $this->nodeEntity->name = $this->request->getPost('nama');
            $this->nodeEntity->fill($this->request->getPost());
            $this->amalUsahaEntity->node_id = $this->nodeModel->insert($this->nodeEntity);
            $this->amalUsahaEntity->gambar = $gambar_name;
            $this->amalUsahaEntity->fill($this->request->getPost());
            $this->amalUsahaModel->save($this->amalUsahaEntity);
            return redirect('pcm/amal-usaha')->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
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
        $amalUsaha = $this->amalUsahaModel->find($id);
        if (!$amalUsaha) {
            return redirect()->to('admin/user')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        return view('petugas/amal-usaha/_form', [
            'title' => 'Amal Usaha',
            'validation' => $this->validation,
            'jenisUsahas' => $this->jenisUSahaModel->find(),
            'amalUsaha' => $amalUsaha
        ]);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $amalUsaha = $this->amalUsahaModel->find($id);
        if (!$amalUsaha) {
            return redirect()->to('pcm/amal-usaha')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        if ($this->validation->run($this->request->getPost(), 'updateAmalUsaha')) {
            $gambar = $this->request->getFile('gambar');
            $_gambar = $this->request->getPost('_gambar');
            if ($gambar->getError() == 4) {
                $this->amalUsahaEntity->gambar = $_gambar == '' ? 'default.png' : $_gambar;
            } else {
                $gambar_name = $gambar->getRandomName();
                if ($gambar->move('upload/object', $gambar_name)) {
                    @unlink(FCPATH . 'upload/object/' . $_gambar);
                    $this->amalUsahaEntity->gambar = $gambar_name;
                }
            }
            $this->amalUsahaEntity->fill($this->request->getPost());
            $this->amalUsahaModel->save($this->amalUsahaEntity);
            return redirect('pcm/amal-usaha')->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
        } else {
            return redirect()->to('pcm/amal-usaha/' . $id . '/edit')->withInput()->with('validation', $this->validation->getErrors());
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $amalUsaha = $this->amalUsahaModel->find($id);
        if (!$amalUsaha) {
            return redirect()->to('pcm/amal-usaha')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        $this->amalUsahaModel->delete($id);
        return redirect()->back()->with('delete_success', alert('success', 'Data berhasil dihapus', 'Berhasil'));
    }
}
