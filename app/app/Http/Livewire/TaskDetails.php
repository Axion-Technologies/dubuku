<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tasks;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;

class TaskDetails extends Component
{

    public $task_id, $task_details, $new_comment, $comments=[];

    public function mount($task_id)
    {
        $this->task_id = $task_id;
        $this->loadTaskDetails();
        $this->loadComments();
    }

    public function loadTaskDetails()
    {
        $company_id = Auth::user()->comp_id;

        $this->task_details = Tasks::select('id', 'created_by', 'heading', 'description', 'priority', 'status', 'created_at')
                                 ->where('id', $this->task_id)
                                 ->where('company_id', $company_id)
                                 ->first();
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
                                'status'     => Comments::STATUS_PUBLISHED,
                                'public'     => Comments::PUBLIC_YES,
                                'comment'    => $new_comment,
                            ]);

        if ($comment_created)
        {
            session()->flash('success', 'Task Comment successfully created');
        }
        else
        {
            session()->flash('error', 'Task Comment not successfully created');
        }

        $this->new_comment = '';
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = Comments::with('user')
            ->where('task_id', $this->task_id)
            ->where('status', 'published')
            ->latest('created_on')
            ->get();
    }

    public function render()
    {
        return view('livewire.task-details');
    }
}
