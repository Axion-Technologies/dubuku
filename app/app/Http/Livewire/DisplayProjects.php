<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Projects;
use Illuminate\Support\Facades\Auth;

class DisplayProjects extends Component
{

    public $projects;

    public function mount()
    {
        $this->loadProjects();
    }

    public function loadProjects()
    {
        $company_id = Auth::user()->comp_id;

        $this->projects = Projects::select('id', 'name')
                          ->where('company_id', $company_id)
                          ->orderBy('id', 'desc')
                          ->get();
    }

    public function render()
    {
        return view('livewire.display-projects');
    }
}
