<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sprints;

class SprintsApiController extends Controller
{
    public function create(Request $request)
    {
        try {
            $validated = validator([
                'project_id'  => 'required|numeric|exists:projects,id',
                'title'       => 'required|string',
                'description' => 'nullable|string',
                'start_date'  => 'required|date|before_or_equal:end_date',
                'end_date'    => 'required|date|after_or_equal:start_date'
            ]);

            if ($validated-> fails()) {
                return response()->json(['success' => false, 'error' => $validated->errors()->first()], 400);
            }

            $company_id = Auth::user()->comp_id;

            $project_id  = $request->input('project_id');
            $title       = $request->input('title');
            $description = $request->input('description');
            $start_date  = $request->input('start_date');
            $end_date    = $request->input('end_date'); 

            $sprint_created = Sprints::create([
                'company_id'  => $company_id,
                'project_id'  => $project_id,
                'title'       => $title,
                'description' => $description,
                'start_date'  => $start_date,
                'end_date'    => $end_date 
            ]);      
            
            if ($sprint_created) {
                return response()->json(['success' => true, 'message' => "Sprint successfully created"], 200);
            }
            else {
                return response()->json(['success' => false, 'error' => 'Sprint was not successfully'], 400);
            }
        }
        catch (\Throwable $th) {
            $message = $th->getMessage();
            return response()->json(["success" => false,  'error' => $message], 400);
        }
    }

    public function get($project_id, Request $request) 
    {
        try {
            $company_id = Auth::user()->comp_id;

            $project_sprint = Sprints::select('id', 'title', 'start_date', 'end_date', 'status')
                              ->where('project_id', $project_id)
                              ->where('status', '!=', Sprints::STATUS_CANCELLED)
                              ->where('company_id', $company_id)
                              ->orderBy('id', 'desc')
                              ->get()
                              ->toArray();

            if ($project_sprint) {
                return response()->json(['success' => true, 'data' => $project_sprint], 200);
            }
            else {
                return response()->json(['success' => false, 'error' => "No project sprint found"], 400);
            }
        }
        catch (\Throwable $th) {
            $message = $th->getMessage();
            return response()->json(["success" => false,  'error' => $message], 400);
        }
    }

    public function get_details($project_id, $sprint_id, Request $request)
    {
        try {
            $company_id = Auth::user()->comp_id;

            $sprint_details = Sprints::select('id', 'title', 'start_date', 'end_date', 'status')
                              ->where('id', $sprint_id)
                              ->where('project_id', $project_id)
                              ->where('company_id', $company_id)
                              ->first();

            if ($sprint_details) {
                return response()->json(['success' => true, 'data' => $sprint_details], 200);
            }
            else {
                return response()->json(['success' => false, 'error' => 'No sprint details found'], 404);
            }
        }
        catch (\Throwable $th) {
            $message = $th->getMessage();
            return response()->json(["success" => false,  'error' => $message], 400);
        }
    }

    public function change_status($project_id, $sprint_id, Request $request)
    {
        try {
            $status = $request->input('status');
            $company_id = Auth::user()->comp_id;

            $sprint = Sprints::where('id', $sprint_id)
                     ->where('project_id', $project_id)
                     ->where('company_id', $company_id)
                     ->first();

            if (!$sprint) {
                return response()->json(['success' => false, 'message' => 'Sprint not found'], 404);
            }

            $sprint->status = $status;
            $sprint->save();

            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        } 
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 400);
        }
    }
}
