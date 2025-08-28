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
            <label>Email</label>
            <input type="email" wire:model="email" class="form-control">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" wire:model="password" class="form-control">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
            wire:loading.attr="disabled"
            wire:target="submit" class="btn custom-btn" style="width: 100%;">
            Login
        </button>
    </form> 
</div>
