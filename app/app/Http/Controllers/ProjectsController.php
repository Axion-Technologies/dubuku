<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    public function index(Request $request)
    {
        echo view('header.header');
        echo view('projects.display_user_projects');
        echo view('footer.footer');
    }

    public function project_work($project_id, Request $request)
    {
        echo view('header.header');
        echo view('projects.display_project_work', compact('project_id'));
        echo view('footer.footer');
    }


    public function project_summary($project_id, Request $request)
    {
        echo view('header.header');
        echo view('projects.display_project_summary', compact('project_id'));
        echo view('footer.footer');
    }


    public function project_report($project_id, Request $request)
    {
        echo view('header.header');
        echo view('projects.display_project_report', compact('project_id'));
        echo view('footer.footer');
    }


    public function project_issues($project_id, Request $request)
    {
        echo view('header.header');
        echo view('projects.display_project_issues', compact('project_id'));
        echo view('footer.footer');
    }


    //Admin methods below


    public function admin_projects(Request $request)
    {
        echo view('header.header');
        echo view('admin.projects.display_admin_projects');
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


    public function user_mapping($project_id, Request $request)
    {
        echo view('header.header');
        echo view('admin.projects.project_user_mapping', compact('project_id'));
        echo view('footer.footer');
    }


    

}
