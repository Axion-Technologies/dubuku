<div>
    <form wire:submit.prevent="submit">
        <div class="mb-4">
            <p><b>Note: </b><span class="text-muted">Password should contain atleast one uppercase, one lowercase, one number, one symbol and minimum of 10 characters !</span></p>
        </div>

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
            <label>First Name <font color="red">*</font></label>
            <input type="text" wire:model="first_name" class="form-control">
            @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Last Name <font color="red">*</font></label>
            <input type="text" wire:model="last_name" class="form-control">
            @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Email <font color="red">*</font></label>
            <input type="email" wire:model="email" class="form-control">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Password <font color="red">*</font></label>
            <input type="password" wire:model="password" class="form-control" data-bs-toggle="tooltip" title="">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label>User Role <font color="red">*</font></label>
            <select wire:model="user_role" class="form-select mb-4">
                <option value="" hidden>Select role</option>
                <option value="1">User</option>
                <option value="2">Manager</option>
                <option value="3">Admin</option>
            </select>
            @error('user_role') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
            wire:loading.attr="disabled"
            wire:target="submit" class="btn custom-btn px-md-5">
            Create
        </button>
    </form>
</div>
