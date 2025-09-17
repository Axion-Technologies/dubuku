<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SprintsController extends Controller
{

    public function index(Request $request)
    {
        echo view('header.header');
        echo view('sprints.display_sprints');
        echo view('footer.footer');
    }
}
