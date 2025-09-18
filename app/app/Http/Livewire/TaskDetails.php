<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Users;
use App\Models\Tasks;
use App\Models\Comments;
use App\Http\Livewire\Quill;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskDetails extends Component
{

    public $task_id, $task_details, $new_comment, $comments=[], $user_id, $status, $priority, $new_owner_id, $users = [];

    public $listeners = [
        Quill::EVENT_VALUE_UPDATED
    ];

    public function quill_value_updated($value)
    {
        $this->new_comment = $value;
        $this->loadTaskDetails();
    }


    public function mount($task_id)
    {
        $this->task_id = $task_id;

        $company_id = Auth::user()->comp_id;

        $task = Tasks::where('id', $this->task_id)
                    ->where('company_id', $company_id)
                    ->first();

        if ($task) {
            $this->status = $task->status;
        }

        $this->users = Users::where('comp_id', Auth::user()->comp_id)->get();

        $this->loadTaskDetails();
        $this->loadComments();
    }

    public function loadTaskDetails()
    {
        $company_id = Auth::user()->comp_id;

        $this->task_details = Tasks::select('tasks.id', 'tasks.created_by', 'users.first_name', 'users.last_name',
                                            'tasks.heading', 'tasks.description', 'tasks.priority', 'tasks.status', 
                                            'tasks.owned_by', 'tasks.created_at')
                              ->join('users', 'users.id', '=', 'tasks.created_by')
                              ->where('tasks.id', $this->task_id)
                              ->where('company_id', $company_id)
                              ->first();

        $this->new_owner_id = $this->task_details->owned_by;

        $this->priority = $this->task_details->priority;
                                
    }

    public function newTaskComment()
    {
        $this->validate([
            'new_comment' => 'required|string|max:1000',
        ]);

        $company_id = Auth::user()->comp_id;
        $user_id    = Auth::user()->id;

        $task_id     = $this->task_id;
        $new_comment = $this->new_comment;
 
        $comment_created = Comments::create([
                                'task_id'    => $task_id,
                                'company_id' => $company_id,
                                'created_by' => $user_id,
                                'created_on' => now(),
                                'public'     => Comments::PUBLIC_YES,
                                'comment'    => $new_comment,
                            ]);

        if ($comment_created)
        {
            session()->flash('success_comment', 'Task Comment successfully created');

            $this->new_comment = '';
            $this->dispatchBrowserEvent('reset-quill');
            $this->loadComments();
        }
        else
        {
            session()->flash('error_comment', 'Task Comment not successfully created');
        }
    }

    public function loadComments()
    {
        $this->comments = Comments::with('user')
            ->where('task_id', $this->task_id)
            ->where('public', Comments::PUBLIC_YES)
            ->latest('created_on')
            ->get();
    }

    public function takeTask()
    {
        $this->validate([
            'task_id' => 'required|numeric|exists:tasks,id',
        ]);

        $company_id = Auth::user()->comp_id;
        $user_id    = Auth::user()->id;

        $task = Tasks::where('id', $this->task_id)
                    ->where('status', Tasks::STATUS_NEW)
                    ->where('company_id', $company_id)
                    ->first();

        if (!$task) 
        {
            session()->flash('error', 'Task already assigned to someone, so it cannot be taken');
        }

        $updated = Tasks::where('id', $this->task_id)
                        ->where('company_id', $company_id)
                        ->update([
                            'status' => Tasks::STATUS_INPROGRESS,
                            'owned_by' => $user_id
                        ]);

        if ($updated) 
        {
            session()->flash('success', 'Task taken successfully.');
        } 
        else 
        {
            session()->flash('success', 'Task was not taken successfully');
            return;
        } 

        $this->loadTaskDetails();
        $this->loadComments();
    }

    public function changeTaskStatus()
    {
        $this->validate([
            'task_id' => 'required|numeric|exists:tasks,id',
            'status' => 'required|string',
        ]);

        $company_id = Auth::user()->comp_id;
        $user_id    = Auth::user()->id;

        if ($this->status === Tasks::STATUS_NEW) {
            session()->flash('error', 'Task status cannot be changed to new.');
            return;
        }

        $existing_status = Tasks::where('id', $this->task_id)
                             ->where('status', $this->status)
                             ->where('company_id', $company_id)
                             ->exists();

        if ($existing_status) {
            session()->flash('error', 'Task status is same as provided status.');
            return;
        }

        $task_status = Tasks::select('status')
                         ->where('id', $this->task_id)
                         ->where('company_id', $company_id)
                         ->first();

        if ($task_status->status === Tasks::STATUS_MERGED) {
            session()->flash('error', 'Status of merged task cannot be changed.');
            return;
        }

        if ($task_status->status === Tasks::STATUS_DELETED) {
            session()->flash('error', 'Status of deleted task cannot be changed.');
            return;
        }

        // update task status
        $updated = Tasks::where('id', $this->task_id)
                     ->where('company_id', $company_id)
                     ->update(['status' => $this->status]);

        if ($updated) {
            if ($this->status === 'resolved') {
                Tasks::where('id', $this->task_id)
                    ->where('company_id', $company_id)
                    ->update([
                        'resolved_on' => Carbon::now(),
                        'resolved_by' => $this->user_id,
                    ]);
            }
            
            session()->flash('success', 'Task status changed successfully.');
            $this->loadTaskDetails();
            $this->emit('taskStatusChanged', $this->task_id);

        } 
        else {
            session()->flash('error', 'Task status not changed successfully.');
        }
    }

    public function changeTaskPriority()
    {
        $this->validate([
            'task_id'  => 'required|numeric|exists:tasks,id',
            'priority' => 'required|string',
        ]);

        $company_id = Auth::user()->comp_id;
        $user_id = Auth::id();

        // fetch the task
        $task = Tasks::where('id', $this->task_id)
                     ->where('company_id', $company_id)
                     ->first();

        if (!$task) {
            session()->flash('error', 'Task not found.');
            return;
        }

        if ($task->priority === $this->priority) {
            session()->flash('error', 'Task priority is same as provided priority.');
            return;
        }

        if ($task->status === Tasks::STATUS_MERGED) {
            session()->flash('error', 'Priority of merged task cannot be changed.');
            return;
        }

        if ($task->status === Tasks::STATUS_DELETED) {
            session()->flash('error', 'Priority of deleted task cannot be changed.');
            return;
        }

        // update task priority
        $updated = $task->update([
            'priority' => $this->priority,
        ]);

        if ($updated) {
            session()->flash('success', 'Task priority changed successfully.');
            $this->loadTaskDetails();
            $this->emit('taskPriorityChanged', $this->task_id);
        } 
        else {
            session()->flash('error', 'Task priority not changed successfully.');
        }
    }

    public function changeTaskOwner()
    {
        $company_id = Auth::user()->comp_id;

        $this->validate([
            'task_id' => 'required|numeric|exists:tasks,id',
            'new_owner_id' => 'required|numeric|exists:users,id',
        ]);

        $task = Tasks::where('id', $this->task_id)
                     ->where('company_id', $company_id)
                     ->first();

        if (!$task) {
            session()->flash('error', 'Task not found.');
            return;
        }

        if ($task->status === Tasks::STATUS_NEW) {
            session()->flash('error', 'Task status is new. Please take the task first.');
            return;
        }

        if ($task->status === Tasks::STATUS_MERGED) {
            session()->flash('error', 'Task owner cannot be changed for a merged task.');
            return;
        }

        if ($task->status === Tasks::STATUS_DELETED) {
            session()->flash('error', 'Task owner cannot be changed for a deleted task.');
            return;
        }

        if ($task->owned_by == $this->new_owner_id) {
            session()->flash('error', 'Existing task owner is the same as the provided owner.');
            return;
        }

        $updated = Tasks::where('id', $this->task_id)
                        ->where('company_id', $company_id)
                        ->update([
                            'owned_by' => $this->new_owner_id
                        ]);

        if ($updated) {
            session()->flash('success', 'Task owner changed successfully.');

            $this->loadTaskDetails();
            $this->emit('taskOwnerChanged', $this->task_id);
        } 
        else {
            session()->flash('error', 'Task owner was not changed.');
        }
    }
}
