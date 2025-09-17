<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Projects;
use App\Models\Users;

class ProjectUserMapping extends Component
{
    public $projectId;
    public $users = [];
    public $selectedUsers = [];

    public function mount($projectId)
    {
        $this->projectId = $projectId;

        // Fetch all users of same company as project
        $project = Projects::findOrFail($projectId);
        $this->users = Users::where('comp_id', $project->company_id)
                           ->select('id', 'first_name', 'last_name', 'email')
                           ->get();

        // Already mapped users
        $this->selectedUsers = $project->users()->pluck('users.id')->toArray();
    }

    public function save()
    {
        $project = Projects::findOrFail($this->projectId);

        $syncData = [];
        foreach ($this->selectedUsers as $userId) {
            $syncData[$userId] = ['company_id' => $project->company_id];
        }

        $project->users()->sync($syncData);

        session()->flash('message', 'Users mapped successfully.');
    }

    public function render()
    {
        return view('livewire.project-user-mapping');
    }
}