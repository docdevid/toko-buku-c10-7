<?php

namespace App\Controllers\auth;

use App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Models\UserModel;

class RegistrasiController extends BaseController
{

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->UserEntity = new UserEntity();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data  = [
            'title' => 'Registrasi | ' . getAppName(),
            'validation' => $this->validation,
        ];
        return view('auth/registrasi', $data);
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

            $this->UserEntity->role = 'MEMBER';
            $this->UserEntity->gambar = $gambar_name;
            $this->UserEntity->fill($this->request->getPost());
            $this->UserModel->save($this->UserEntity);
            return redirect('login')->with('success_register', alert('success', 'Akun anda berhasil dibuat', 'Berhasil'));
        } else {
            return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
        }
    }
}
