<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function index(Request $request)
    {
        echo view('header.header-login');
        echo view('signup.signup');
        echo view('footer.footer');
    }
}
