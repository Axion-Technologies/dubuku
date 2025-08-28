<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index(Request $request)
    {
        echo view('header.header');
        echo view('tasks.display_tasks');
        echo view('footer.footer');
    }

    public function create(Request $request)
    {
        echo view('header.header');
        echo view('tasks.create_tasks');
        echo view('footer.footer');
    }

    public function get($task_id, Request $request)
    {
        echo view('header.header');
        echo view('tasks.task_details', compact('task_id'));
        echo view('footer.footer');
    }

    public function uploadTrixImage(Request $request)
    {
        $path = $request->file('file')->store('trix-images', 'public');
        return response()->json([
            'url' => Storage::url($path)
        ]);
    }

}
