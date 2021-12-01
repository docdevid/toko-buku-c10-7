<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class LogoutController extends BaseController
{
    public function index()
    {
        unset($_SESSION['userdata']);
        return redirect()->to('login')->with('success_logout', 'Logout success');
    }
}
