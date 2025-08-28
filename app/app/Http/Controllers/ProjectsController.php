<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    public function index(Request $request)
    {
        echo view('header.header');
        echo view('admin.projects.display_projects');
        echo view('footer.footer');
    }

    public function display_user_projects(Request $request)
    {
        echo view('header.header');
        echo view('admin.projects.display_user_projects');
        echo view('footer.footer');
    }

    public function create(Request $request)
    {
        echo view('header.header');
        echo view('admin.projects.create_project');
        echo view('footer.footer');
    }

    public function get($project_id, Request $request)
    {
        echo view('header.header');
        echo view('admin.projects.project_details', compact('project_id'));
        echo view('footer.footer');
    }

}
