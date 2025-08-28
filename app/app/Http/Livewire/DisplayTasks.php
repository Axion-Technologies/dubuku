<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;

class DisplayTasks extends Component
{
    use WithPagination;

    public $perPage = 10;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $company_id = Auth::user()->comp_id;

        $tasks = Tasks::select('tasks.id', 'tasks.heading', 'tasks.priority', 'tasks.status', 'tasks.created_at', 'tasks.ticket_type', 'projects.name as project_name')
                    ->leftJoin('projects', 'tasks.project_id', '=', 'projects.id')
                    ->where('tasks.company_id', $company_id)
                    ->orderBy('tasks.id', 'desc')
                    ->paginate($this->perPage);

        return view('livewire.display-tasks', [
            'tasks' => $tasks
        ]);
    }
}

