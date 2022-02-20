<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class LogoutController extends BaseController
{
    public function index()
    {
        unset($_SESSION['userdata']);
        unset($_SESSION['cart_items']);
        return redirect()->to('login')->with('success_logout', alert('success', 'Logout sukses'));
    }
}
