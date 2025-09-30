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

        <div class="mb-3" x-data="{ show: false }">
            <label>Password</label>
            <div class="input-group">
                <input :type="show ? 'text' : 'password'" wire:model="password" class="form-control">
                <span class="input-group-text" @click="show = !show" style="cursor: pointer;">
                    <i :class="show ? 'fa fa-eye' : 'fa fa-eye-slash'"></i>
                </span>
            </div>
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div> 

        <button type="submit"
            wire:loading.attr="disabled"
            wire:target="submit" class="btn custom-btn" style="width: 100%;">
            Login
        </button>
    </form> 
</div> 

