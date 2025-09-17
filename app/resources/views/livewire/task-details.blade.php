<div>
    @if ($task_details && $task_details->status === \App\Models\Tasks::STATUS_NEW)
        <p align="right">
            <button type="button" class="btn btn-xs btn-success" wire:click="takeTask" 
            wire:loading.attr="disabled" wire:target="takeTask" id="takeTaskBtn">Take</button>
        </p>
    @endif
    @if ($task_details)
    <div class="row ">
        @if (session()->has('success'))
                <div class="text-green-500">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="text-red-500">
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                <br></div>
            @endif
        <div class="col-md-6">
            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Title :</b></div>
                <div class="col-6 col-md-8">{{ $task_details->heading }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Created On :</b></div>
                <div class="col-6 col-md-8">{{ $task_details->created_at->format('d M Y, h:i A') }}</div>
            </div>  

            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Created By :</b></div>
                <div class="col-6 col-md-8">{{ $task_details->first_name }} {{ $task_details->last_name }}</div>
            </div>
        </div>
        <div class="col-md-6">

            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Owned By :</b></div>
                <div class="col-6 col-md-8">
                    <select wire:model="new_owner_id" wire:change="changeTaskOwner" class="form-select">
                        <option value="">-- Select --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                        @endforeach
                    </select>
                    @error('new_owner_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div> 

            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Status :</b></div>
                <div class="col-6 col-md-8">
                    @if ($task_details->status === 0 || $task_details->status === 4 || $task_details->status === 5)
                    @if ($task_details->status === 0)
                        New
                    @elseif ($task_details->status === 4)
                        Deleted
                    @else
                        Merged
                    @endif
                    @else
                    <select class="form-select" wire:model="status" wire:change="changeTaskStatus">
                        <option value="1">In Progress</option>
                        <option value="2">On Hold</option>
                        <option value="3">Completed</option>
                        <option value="4">Delete</option>
                        <option value="5">Merged</option>
                    </select>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Priority :</b></div>
                <div class="col-6 col-md-8">
                    <select class="form-select" wire:model="priority" wire:change="changeTaskPriority">
                        <option value="0">Low</option>
                        <option value="1">Medium</option>
                        <option value="2">High</option>
                        <option value="3">Critical</option>
                    </select>
                    @error('priority') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        @else
        <p>Task Details not found</p>
        @endif
        <hr>
        <div class="row mb-4 mt-3">
            <div class="col-12">
                <b>Description :</b>
                <div class="quill-content mt-2">
                   {!! $task_details->description !!}
                </div>
            </div>
        </div>
        <hr>

        <div class="row mt-3">
            <form wire:submit.prevent="newTaskComment">
            @if (session()->has('success_comment'))
                <div class="text-green-500">
                    <div class="alert alert-success">
                        {{ session('success_comment') }}
                    </div>
                </div>
            @endif
            @if (session()->has('error_comment'))
                <div class="text-red-500">
                    <div class="alert alert-danger">
                        {{ session('error_comment') }}
                    </div>
                <br></div>
            @endif
            <div class="col-md-12 mx-auto"> 
                <label for="comment"><strong>Add Comment:</strong></label>
                <livewire:quill :value="$new_comment" />
                <br>
                 @error('new_comment') <span class="text-danger">{{ $message }}</span> @enderror
                <p align="right"><button type="submit" wire:loading.attr="disabled"
                wire:target="newTaskComment" class="btn custom-btn mt-2">Save</button></p>
            </form>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <p><strong>Comments :</strong></p>
        <br><br>
        <div class="col-md-12">
            @if ($comments && $comments->count() > 0)
                @foreach ($comments as $item)
                        <p>
                            <strong>Comment by :</strong> {{ $item->user->first_name . ' ' . $item->user->last_name }}<br>
                            <strong>Comment on :</strong> {{ $item->created_on->format('d M Y, h:i A') }}
                        </p>
                        <!-- <p>{!! str_replace(['{', '}'], '', $item->comment) !!}</p> -->
                        <p>{!! $item->comment !!}</p>

                    <hr><br>
                @endforeach
            @else
                <p>No comments found</p>
            @endif
        </div>
    </div>
</div>
