<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class LogoutController extends BaseController
{
    public function index()
    {
        session()->destroy();
        return redirect()->to('login')->with('success_logout', 'Logout success');
    }
}
