<?php

namespace App\Controllers\auth;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data  = [
            'title' => 'Login',
            'validation' => $this->validation,
        ];
        return view('auth/login', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $this->validation->setRuleGroup('login');
        if ($this->validation->run($this->request->getPost())) {
            $user = $this->userModel->getLogin($this->request->getPost('username'))->first();
            if ($user) {
                if (password_verify($this->request->getPost('password'), $user->password)) {
                    $this->session->set('userdata', $user);
                    if ($this->session->get('userdata')->role == 'MEMBER') {
                        return redirect()->to('member/iklan');
                    }
                    return redirect()->to('admin/dashboard');
                } else {
                    return redirect()->to('login')->withInput()->with('error_login', alert('danger', 'Username atau password salah', 'Gagal '));
                }
            } else {
                return redirect()->to('login')->withInput()->with('error_login', alert('danger', 'Username atau password salah', 'Gagal '));
            }
        } else {
            return redirect()->to('login')->withInput()->with('validation', $this->validation);
        }
    }
}
