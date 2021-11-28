<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userEntity = new UserEntity();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('admin/user/index', [
            'title' => 'Pengguna',
            'users' => $this->userModel->get($this->request->getGet('search'))->paginate(10),
            'pager' => $this->userModel->pager
        ]);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('admin/user')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        return view('admin/user/show', [
            'title' => 'Pengguna',
            'validation' => $this->validation,
            'user' => $user
        ]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('admin/user/_form', [
            'title' => 'Pengguna',
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
        if ($this->validation->run($this->request->getPost(), 'createUser')) {
            $gambar = $this->request->getFile('gambar');
            $gambar_name = $gambar->getRandomName();
            $gambar->move('upload/user', $gambar_name);
            $this->userEntity->gambar = $gambar_name;
            $this->userEntity->fill($this->request->getPost());
            $this->userModel->save($this->userEntity);
            return redirect('admin/user')->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
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
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('admin/user')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        return view('admin/user/_form', [
            'title' => 'Pengguna',
            'validation' => $this->validation,
            'user' => $user
        ]);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('admin/user')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        if ($this->validation->run($this->request->getPost(), 'updateUser')) {
            $gambar = $this->request->getFile('gambar');
            $_gambar = $this->request->getPost('_gambar');
            if ($gambar->getError() == 4) {
                $this->userEntity->gambar = $_gambar == '' ? 'default.png' : $_gambar;
            } else {
                $gambar_name = $gambar->getRandomName();
                if ($gambar->move('upload/user', $gambar_name)) {
                    @unlink(FCPATH . 'upload/user/' . $_gambar);
                    $this->userEntity->gambar = $gambar_name;
                }
            }
            $this->userEntity->fill($this->request->getPost());
            $this->userModel->save($this->userEntity);
            return redirect('admin/user')->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
        } else {
            return redirect()->to('admin/user/new')->withInput()->with('validation', $this->validation->getErrors());
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('admin/user')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        $this->userModel->delete($id);
        return redirect()->to('/admin/user')->with('delete_success', alert('success', 'Data berhasil dihapus', 'Berhasil'));
    }
}
