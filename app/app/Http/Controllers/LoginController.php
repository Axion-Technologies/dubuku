<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    public function index(Request $request) 
    {
        if (Auth::check()) {
            return redirect('/home');
        }

        echo view('header.header-login');
        echo view('login.login');
        echo view('footer.footer');
    }


    public function logout(Request $request) 
    {
        Auth::logout();
        return redirect('/login');
    }

}
