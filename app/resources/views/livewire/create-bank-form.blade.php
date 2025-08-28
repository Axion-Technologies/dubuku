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
            <label>Bank Name<font color="red">*</font></label>
            <input type="text" wire:model="bank_name" class="form-control">
            @error('bank_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Branch<font color="red">*</font></label>
            <input type="text" wire:model="branch" class="form-control">
            @error('branch') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Account Holder Name<font color="red">*</font></label>
            <input type="text" wire:model="account_holder_name" class="form-control">
            @error('account_holder_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Account Number<font color="red">*</font></label>
            <input type="text" wire:model="account_number" class="form-control">
            @error('account_number') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>IFSC Code<font color="red">*</font></label>
            <input type="text" wire:model="ifsc_code" class="form-control">
            @error('ifsc_code') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Account Type<font color="red">*</font></label>
            <select wire:model="account_type" class="form-select">
                <option value="" hidden>Select type</option>
                <option value="1">Current</option>
                <option value="2">Savings</option>
            </select>
            @error('account_type') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Phone Number</label>
            <input type="tel" wire:model="phone_number" class="form-control mb-4">
            @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
            wire:loading.attr="disabled"
            wire:target="submit" class="btn custom-btn px-md-5">
            Add Account
        </button>
    </form>
</div>
