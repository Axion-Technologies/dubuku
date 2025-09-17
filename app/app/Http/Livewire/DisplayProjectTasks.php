<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tasks;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class DisplayProjectTasks extends Component
{
    use WithPagination;

    public $perPage = 200;
    protected $paginationTheme = 'bootstrap';

    public $project_id;

    // Filters
    public $creator = '';
    public $owner = '';
    public $status = '';
    public $priority = '';
    public $task_type = '';

    public function mount($project_id)
    {
        $this->project_id = $project_id;
    }

    public function updating($property)
    {
        // reset to first page when filters change
        if (in_array($property, ['owner', 'status', 'task_type'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $company_id = Auth::user()->comp_id;

        $unwanted_status = [
            Tasks::STATUS_COMPLETED,
            Tasks::STATUS_DELETED,
            Tasks::STATUS_MERGED,
        ];

        $query = Tasks::select('tasks.id', 'projects.name AS project_name', 'tasks.heading', 'priority', 'status', 'tasks.created_at', 'tasks.created_by', 'tasks.owned_by')
            ->join('projects', 'projects.id', '=', 'tasks.project_id')
            ->where('tasks.project_id', $this->project_id)
            ->where('tasks.company_id', $company_id);

        // 🔹 Apply filters
        if ($this->creator !== '') {
            $query->where('tasks.created_by', $this->creator);
        }

        if ($this->owner !== '') {
            //dd($this->owner);
            $query->where('tasks.owned_by', $this->owner);
        }

        if ($this->status !== '') {
            $query->where('tasks.status', $this->status);
        }
        else {
            $query->whereNotIn('tasks.status', $unwanted_status);
        }

        if ($this->priority !== '') {
            $query->where('tasks.priority', $this->priority);
        }

        if ($this->task_type !== '') {
            $query->where('tasks.ticket_type', $this->task_type);
        }

        $project_tasks = $query->orderBy('tasks.id', 'desc')->paginate($this->perPage);

        // Pass owners list for filter
        $owners = Users::where('comp_id', $company_id)
        ->selectRaw("id, CONCAT(first_name, ' ', last_name) as full_name")
        ->pluck('full_name', 'id');

        $creators = Users::where('comp_id', $company_id)
        ->selectRaw("id, CONCAT(first_name, ' ', last_name) as full_name")
        ->pluck('full_name', 'id');

        return view('livewire.display-project-tasks', [
            'project_tasks' => $project_tasks,
            'creators' => $creators,
            'owners' => $owners,
        ]);
    }
}
