<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        echo view('header.header');
        echo view('admin.admin');
        echo view('footer.footer');
    }


    public function users(Request $request)
    {
        echo view('header.header');
        echo view('admin.users.display_users');
        echo view('footer.footer');
    }

    public function create(Request $request)
    {
        echo view('header.header');
        echo view('admin.users.create_user');
        echo view('footer.footer');
    }

}
