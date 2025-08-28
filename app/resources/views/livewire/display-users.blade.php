<div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->user_role === 3)
                            Admin 
                        @elseif ($user->user_role === 2)
                            Manager
                        @else
                            User
                        @endif
                    </td>
                    <td>
                        @if ($user->id === auth()->id())
                            <span class="text-muted">You cannot make changes to your account</span>
                        @else
                        <button class="btn btn-success" wire:click="$set('user_id', {{ $user->id }})" data-bs-toggle="modal" data-bs-target="#changePasswordModal" >Change Password</button>&nbsp &nbsp
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">No active users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Change Password Modal -->
        <div wire:ignore.self class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form wire:submit.prevent="changeUserPassword">
                        <div class="modal-header">
                            <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="clearFields"></button>
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
</div>
