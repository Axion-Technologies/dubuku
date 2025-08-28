<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Projects;

class ProjectDetails extends Component
{

    public $project_id, $project_details;

    public function mount($project_id)
    {
        $this->project_id = $project_id;
        $this->loadProjectDetails();
    }

    public function loadProjectDetails()
    {
        $company_id = Auth::user()->comp_id;

        $this->project_details = Projects::select('id', 'name', 'created_at')
                                 ->where('id', $this->project_id)
                                 ->where('company_id', $company_id)
                                 ->first();
    }

    public function render()
    {
        return view('livewire.project-details');
    }
}
