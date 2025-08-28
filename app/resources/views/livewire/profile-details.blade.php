<div>
    
        @forelse($user_details as $user)
        <p><i class="fa-solid fa-user me-2"></i> {{ $user->first_name }} {{ $user->last_name }}</p>
        <p><i class="fa-solid fa-envelope me-2"></i> {{ $user->email }}</p>
        <p><i class="fa-solid fa-suitcase me-2"></i> 
            @if ($user->user_role === 3)
                Admin 
            @elseif ($user->user_role === 2)
                Manager
            @else
                User
            @endif
        </p>
        <button class="btn home-btn"  data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
        @empty
        <p>User Details not found</p>
        @endforelse
    

    <!-- Change Password Modal -->
    <div wire:ignore.self class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="changePassword">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-4">
                            <p><b>Note: </b><span class="text-muted">Password should contain atleast one uppercase, one lowercase, one number, one symbol and minimum of 10 characters !</span></p>
                        </div>
                        @if (session()->has('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <div class="mb-3">
                            <label>Current Password</label>
                            <input type="password" class="form-control" wire:model.defer="current_password">
                            @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>New Password</label>
                            <input type="password" class="form-control" wire:model.defer="new_password">
                            @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" wire:model.defer="confirm_password">
                            @error('confirm_password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="clearFields">Cancel</button>
                        <button type="submit" class="btn home-btn">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
