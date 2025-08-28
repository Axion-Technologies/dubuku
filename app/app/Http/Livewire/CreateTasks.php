<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tasks;
use App\Models\Projects;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Quill;
use Carbon\Carbon;

class CreateTasks extends Component
{

    public $heading = '';
    public $description = '';
    public $task_type = '';
    public $project_id = '';
    public $priority = Tasks::PRIORITY_LOW;
    public $projects = [];

    // Listen for Quill updates from the child component
    public $listeners = [
        Quill::EVENT_VALUE_UPDATED
    ];


    public function quill_value_updated($value)
    {
        $this->description = $value;
    }


    public function mount()
    {
        // load only projects of the logged-in user's company
        $this->projects = Projects::where('company_id', Auth::user()->comp_id)->get();
    }

    public function submit()
    {
        $this->validate([
            'heading'     => 'required|string',
            'task_type'   => 'required|in:bug,feature,task',
            'project_id'  => 'required|exists:projects,id',
        ]);

        $title       = $this->heading;
        $description = $this->description;
        $priority    = $this->priority;
        $task_type   = $this->task_type;
        $project_id  = $this->project_id;


        $company_id = Auth::user()->comp_id;
        $user_id    = Auth::user()->id;

        $task_created = Tasks::create([
            'company_id'  => $company_id,
            'project_id'  => $project_id,
            'ticket_type' => $task_type, 
            'created_by'  => $user_id,
            'heading'     => $title,
            'description' => $description,
            'priority'    => $priority,
            'created_on' => Carbon::now()
        ]);

        if ($task_created) {
            session()->flash('success', 'Task successfully created');
            $this->reset(['heading', 'description', 'priority', 'task_type', 'project_id']);
            $this->priority = Tasks::PRIORITY_LOW;
            $this->dispatchBrowserEvent('reset-trix');
        } 
        else {
            session()->flash('error', 'Task was not created successfully. Try again');
        }
    }

    
    public function render()
    {
        return view('livewire.create-tasks');
    }
}
