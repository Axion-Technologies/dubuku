<div>
    <form wire:submit.prevent="submit">
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

        <div class="mb-3">
            <label>Project<font color="red">*</font></label>
            <input type="text" wire:model="project_name" class="form-control">
            @error('project_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
            wire:loading.attr="disabled"
            wire:target="submit" class="btn custom-btn px-md-5">
            Create Project
        </button>
    </form>
</div>
