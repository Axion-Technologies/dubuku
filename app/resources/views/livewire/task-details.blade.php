<div>
    @if ($task_details)
    <div class="row ">
        <div class="col-md-6">
            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Title :</b></div>
                <div class="col-6 col-md-8">{{ $task_details->heading }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Status :</b></div>
                <div class="col-6 col-md-8">{{ $task_details->status }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Priority :</b></div>
                <div class="col-6 col-md-8">{{ $task_details->priority }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Description :</b></div>
                <div class="col-6 col-md-8">{{ $task_details->description }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Created On :</b></div>
                <div class="col-6 col-md-8">{{ $task_details->created_at->format('d M Y, h:i A') }}</div>
            </div>  
        </div>
        <div class="col-md-6">
            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Created By :</b></div>
                <div class="col-6 col-md-8">{{ $task_details->created_by }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Status :</b></div>
                <div class="col-6 col-md-8">{{ $task_details->status }}</div>
            </div>
        </div>
        @else
        <p>Task Details not found</p>
        @endif
        <hr>

        <div class="row mt-3">
            <form wire:submit.prevent="newTaskComment">
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
            <div class="col-md-12 mx-auto"> 
                <label for="comment"><strong>Add Comment:</strong></label>
                <textarea type="text" wire:model="new_comment"  class="form-control" rows="4"></textarea>
                <br>
                <div class="col-md-12">
                    <input type="file" ref="fileInput">
                </div>
                 @error('new_comment') <span class="text-danger">{{ $message }}</span> @enderror
                <br>
                <button type="submit" wire:loading.attr="disabled"
                wire:target="newTaskComment" class="btn custom-btn mt-2">Save</button>
            </form>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <div class="row">
        <p><strong>Comments</strong></p>
        <br><br>
        <div class="col-md-12">
            @if ($comments && $comments->count() > 0)
                @foreach ($comments as $item)
                        <p>
                            <strong>Comment by:</strong> {{ $item->user->first_name . ' ' . $item->user->last_name }}<br>
                            <strong>Comment on:</strong> {{ $item->created_on->format('d M Y, h:i A') }}
                        </p>
                        <p>{!! nl2br(e($item->comment)) !!}</p>

                    <hr><br>
                @endforeach
            @else
                <p>No comments found</p>
            @endif
        </div>
    </div>
</div>
