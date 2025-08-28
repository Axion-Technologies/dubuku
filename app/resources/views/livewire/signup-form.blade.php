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
            <label>First Name</label>
            <input type="text" wire:model="first_name" class="form-control">
            @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" wire:model="last_name" class="form-control">
            @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Company Name</label>
            <input type="text" wire:model="comp_name" class="form-control">
            @error('comp_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" wire:model="email" class="form-control">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
            wire:loading.attr="disabled"
            wire:target="submit" class="btn custom-btn" style="width: 100%;">
            Sign Up
        </button>
    </form> 
</div>
