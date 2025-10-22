<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Projects;

class DisplayProjectName extends Component
{

    public $project_id, $project;

    public function mount($project_id)
    {
        $this->project_id = $project_id;
        $this->project = Projects::findOrFail($project_id);
    }

    public function render()
    {
        return view('livewire.display-project-name');
    }
}
