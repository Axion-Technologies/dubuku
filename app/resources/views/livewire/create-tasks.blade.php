<div>
    <form wire:submit.prevent="submit">
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="mb-3">
            <label>Project <font color="red">*</font></label>
            <select wire:model="project_id" class="form-control">
                <option value="">-- Select Project --</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
            @error('project_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Task type <font color="red">*</font></label>
            <select wire:model="task_type" class="form-control">
                <option value="">-- Select Task Type --</option>
                <option value="bug">Bug</option>
                <option value="feature">Feature</option>
                <option value="task">Task</option>
            </select>
            @error('task_type') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Title <font color="red">*</font></label>
            <input type="text" wire:model="heading" class="form-control">
            @error('heading') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        {{-- Quill editor --}}

        <div class="mb-3">
    <label>Description <font color="red">*</font></label>
    <livewire:quill :value="$description" />
    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
</div>

        <div class="mb-3">
            <label>Priority <font color="red">*</font></label>
            <select wire:model="priority" class="form-control">
                <option value=0>Low</option>
                <option value=1>Medium</option>
                <option value=2>High</option>
                <option value=3>Critical</option>
            </select>
            @error('priority') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" wire:loading.attr="disabled" class="btn custom-btn px-md-5">
            Create Task
        </button>
    </form>
</div>
