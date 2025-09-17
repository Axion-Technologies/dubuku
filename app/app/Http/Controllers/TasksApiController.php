<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\Projects;
use Illuminate\Support\Facades\Auth;

class TasksApiController extends Controller
{
    public function get_my_top_tasks(Request $request)
    {
        try {
            $company_id = Auth::user()->comp_id;
        $user_id    = Auth::user()->id;

        $my_top_tasks = Tasks::select('tasks.id', 'tasks.heading', 'tasks.priority', 'tasks.status', 'tasks.created_at', 'tasks.ticket_type', 'projects.name as project_name')
                        ->leftJoin('projects', 'tasks.project_id', '=', 'projects.id')
                        ->where('tasks.owned_by', $user_id)
                        ->where('tasks.company_id', $company_id)
                        ->orderBy('tasks.id', 'desc')
                        ->take(5)
                        ->get();

        if ($my_top_tasks) {
            return response()->json(['success' => true, 'data' => $my_top_tasks], 200);
        }
        else {
            return response()->json(['success' => false, 'error' => 'No data found'], 404);
        }
        }
        catch (\Throwable $th) {
            $message = $th->getMessage();
            return response()->json(["success" => false,  'message' => $message], 400);
        }
    }

    public function get_all_my_tasks(Request $request)
    {
        try {
            $company_id = Auth::user()->comp_id;
            $user_id    = Auth::user()->id;

            $projects = Projects::where('company_id', auth()->user()->comp_id)->get();

            $all_my_tasks = Tasks::select('tasks.id', 'tasks.heading', 'tasks.priority', 'tasks.status', 'tasks.created_at', 'tasks.ticket_type', 'projects.name as project_name')
                                ->leftJoin('projects', 'tasks.project_id', '=', 'projects.id')
                                ->where('tasks.owned_by', $user_id)
                                ->where('tasks.company_id', $company_id)
                                ->orderBy('tasks.id', 'desc')
                                ->get();

            if ($all_my_tasks) {
                return response()->json(['success' => true, 'data' => $all_my_tasks], 200);
            }
            else {
                return response()->json(['success' => false, 'error' => 'No data found'], 200);
            }
        }
        catch (\Throwable $th) {
            $message = $th->getMessage();
            return response()->json(["success" => false,  'message' => $message], 400);
        }
    }

    public function get_projects()
    {
        try {
            $projects = Projects::where('company_id', auth()->user()->comp_id)->get();

            if ($projects) {
                return response()->json(['success' => true, 'data' => $projects], 200);
            }
            else {
                return response()->json(['success' => false, 'error' => 'No projects found'], 404);
            }
        }
        catch (\Throwable $th) {
            $message = $th->getMessage();
            return response()->json(["success" => false,  'message' => $message], 400);
        }
       
    }

    public function filter_my_tasks(Request $request)
    {
        try {
            $company_id = auth()->user()->comp_id;
            $user_id    = auth()->id();

            $priority   = $request->input('priority');
            $status     = $request->input('status');
            $project_id = $request->input('project_id');

            $query = Tasks::select('tasks.id', 'tasks.heading', 'tasks.priority', 'tasks.status', 'tasks.created_at', 
                        'tasks.ticket_type', 'projects.name as project_name')
                        ->leftJoin('projects', 'tasks.project_id', '=', 'projects.id')
                        ->where('tasks.company_id', $company_id)
                        ->where('tasks.owned_by', $user_id);

            if (!empty($priority)) {
                $query->where('tasks.priority', $priority);
            }

            if (!empty($status)) {
                $query->where('tasks.status', $status);
            }

            if (!empty($project_id)) {
                $query->where('tasks.project_id', $project_id);
            }

            $filtered_tasks = $query->orderBy('tasks.id', 'desc')->get();

            if ($filtered_tasks) {
                return response()->json(['success' => true, 'data' => $filtered_tasks], 200);
            }
            else {
                return response()->json(['success' => false, 'error' => 'No tasks found on this filter'], 404);
            }
        }
        catch (\Throwable $th) {
            $message = $th->getMessage();
            return response()->json(["success" => false,  'message' => $message], 400);
        }
    }
}
