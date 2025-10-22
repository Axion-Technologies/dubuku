<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    public function index(Request $request)
    {
        echo view('header.header');
        echo view('workspace.display-user-workspace');
        echo view('footer.footer');
    }
}
