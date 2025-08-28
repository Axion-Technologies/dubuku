<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Projects;

class CreateProjects extends Component
{
    public $project_name;

    public function submit()
    {
        $this->validate([
            'project_name' => 'required|string',
        ]);

        $project_name = $this->project_name;

        $company_id = Auth::user()->comp_id;

        $project_exists = Projects::where('name', $project_name)
                          ->where('company_id', $company_id)
                          ->exists();
                    
        if ($project_exists) {
            session()->flash('error', 'Project already exist');
            return;
        }

        $project = Projects::create([
            'company_id'    => $company_id,
            'name'          => $project_name,
        ]);

        if ($project) {
            session()->flash('success', 'Project successfully created');
            $this->reset();
        }
        else {
            session()->flash('error', 'Project was not created successfully. Try again');
        }

    }

    public function render()
    {
        return view('livewire.create-projects');
    }
}
