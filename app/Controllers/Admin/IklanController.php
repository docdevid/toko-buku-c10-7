<?php

namespace App\Controllers\Front\Member;

use App\Controllers\BaseController;
use App\Entities\IklanEntity;
use App\Models\IklanModel;

class IklanController extends BaseController
{
    public function __construct()
    {
        $this->IklanModel = new IklanModel();
        $this->IklanEntity = new IklanEntity();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index($kategori = null)
    {

        $iklans = $kategori ?
            $this->IklanModel->getByKategoriUserId($kategori, $this->request->getGet('search'), session('userdata')->id)
            : $this->IklanModel->getUserId($this->request->getGet('search'), session('userdata')->id);
        return view('front/member/iklan/index', [
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
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('front/member/iklan/_form', [
            'title' => 'Iklan',
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
        if ($this->validation->run($this->request->getPost(), 'createIklan')) {
            $gambar = $this->request->getFile('gambar');
            $gambar_name = $gambar->getRandomName();
            $gambar->move('uploads/iklan', $gambar_name);
            $this->IklanEntity->gambar = $gambar_name;
            $this->IklanEntity->fill($this->request->getPost());
            $this->IklanModel->save($this->IklanEntity);
            return redirect('member/iklan')->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
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
        $iklan = $this->IklanModel->find($id);
        return view('front/member/iklan/_form', [
            'title'         => 'Iklan',
            'validation'    => $this->validation,
            'iklan' => $iklan
        ]);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $iklan = $this->IklanModel->find($id);
        if (!$iklan) {
            return redirect()->to('member/iklan')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        if ($this->validation->run($this->request->getPost(), 'updateIklan')) {
            $gambar = $this->request->getFile('gambar');
            $_gambar = $this->request->getPost('_gambar');
            if ($gambar->getError() == 4) {
                $this->IklanEntity->gambar = $_gambar == '' ? 'default.png' : $_gambar;
            } else {
                $gambar_name = $gambar->getRandomName();
                if ($gambar->move('uploads/iklan', $gambar_name)) {
                    @unlink(FCPATH . 'uploads/iklan/' . $_gambar);
                    $this->IklanEntity->gambar = $gambar_name;
                }
            }
            $this->IklanEntity->fill($this->request->getPost());
            $this->IklanModel->save($this->IklanEntity);
            return redirect('member/iklan')->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
        } else {
            return redirect()->to('member/iklan/' . $id . '/edit')->withInput()->with('validation', $this->validation->getErrors());
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $Iklan = $this->IklanModel->find($id);
        if (!$Iklan) {
            return redirect()->to('member/iklan')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        @unlink(FCPATH . 'uploads/iklan/' . $Iklan->gambar);
        $this->IklanModel->delete($id);
        return redirect()->to('member/iklan')->with('delete_success', alert('success', 'Data berhasil dihapus', 'Berhasil'));
    }
}
