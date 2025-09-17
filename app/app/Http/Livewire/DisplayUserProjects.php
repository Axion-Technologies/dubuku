<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Projects;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class DisplayUserProjects extends Component
{
    public $projects;

    public function mount()
    {
        $this->loadProjects();
    }

    public function loadProjects()
    {
        $user = Auth::user();

        if ($user->user_role === Users::ROLE_ADMIN) {
            // Admin → see all company projects
            $this->projects = Projects::select('id', 'name')
                ->where('company_id', $user->comp_id)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            // Manager/User → only projects they are mapped to
            $this->projects = $user->projects()
                ->select('projects.id', 'projects.name')
                ->orderBy('projects.id', 'desc')
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.display-user-projects');
    }
}
