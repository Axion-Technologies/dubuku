<div>
    <h3 class="mb-3">Assign Users to Project</h3>

    <form wire:submit.prevent="save">
        @foreach($users as $user)
            <div>
                <label>
                    <input type="checkbox" 
                           wire:model="selectedUsers" 
                           value="{{ $user->id }}">
                    {{ $user->first_name }} {{ $user->last_name }} ({{ $user->email }})
                </label>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary mt-3">Save</button>
    </form>

    @if (session()->has('message'))
        <div class="alert alert-success mt-2">
            {{ session('message') }}
        </div>
    @endif
</div>
