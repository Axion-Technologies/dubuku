<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return redirect('/projects');
    }


    public function index_old(Request $request)
    {
        echo view('header.header');
        echo view('home.home');
        echo view('footer.footer');
    }


    public function profile(Request $request)
    {
        echo view('header.header');
        echo view('home.profile');
        echo view('footer.footer');
    }
}
