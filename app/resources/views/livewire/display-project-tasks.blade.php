<div class="row">
    <div class="col-md-9">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>Work</th>
                        <th>Assignee</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Creator</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($project_tasks as $project_task)
                    <tr 
                        title="Issue Type: {{ ucfirst($project_task->ticket_type) }}"
                        @if($project_task->ticket_type === 'bug') 
                            style="background-color: #f8d7da;" 
                        @elseif($project_task->ticket_type === 'feature') 
                            style="background-color: #d1ecf1;" 
                        @elseif($project_task->ticket_type === 'improvement') 
                            style="background-color: #d4edda;" 
                        @elseif($project_task->ticket_type === 'task') 
                            style="background-color: #fff3cd;" 
                        @endif
                    >

                        <td><input type="checkbox"></td>
                        <td><a href="/projects/{{$project_id}}/issues/details/{{$project_task->id}}">{{ $project_task->id }} - {{ $project_task->heading }}</a></td>
                        <td>{{ $owners[$project_task->owned_by] ?? 'N/A' }}</td>
                        <td>
                            @if ($project_task->priority === 3) Critical
                            @elseif ($project_task->priority === 2) High
                            @elseif ($project_task->priority === 1) Medium
                            @else Low
                            @endif
                        </td>
                        <td>
                            @if ($project_task->status === 5) Merged
                            @elseif ($project_task->status === 4) Deleted
                            @elseif ($project_task->status === 3) Resolved
                            @elseif ($project_task->status === 2) On Hold
                            @elseif ($project_task->status === 1) In Progress
                            @elseif ($project_task->status === 6) In Review
                            @else New
                            @endif
                        </td>
                        <td>{{ $owners[$project_task->created_by] ?? 'N/A' }}</td>
                        <td>{{ $project_task->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">No tasks found on this project.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div>
                {{ $project_tasks->links() }}
            </div>
        </div>
    </div>

    <div class="col-md-1"></div>

    <div class="col-md-2">
        <h3>Filters</h3>

        <!--  Owner filter -->
        <div class="mb-3">
            <label>Created By</label>
            <select wire:model="creator" class="form-select">
                <option value="">All</option>
                @foreach($creators as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Assigned To</label>
            <select wire:model="owner" class="form-select">
                <option value="">All</option>
                @foreach($owners as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <!--  Status filter -->
        <div class="mb-3">
            <label>Status</label>
            <select wire:model="status" class="form-select">
                <option value="">All</option>
                <option value=0>New</option>
                <option value=1>In Progress</option>
                <option value=2>On Hold</option>
                <option value=3>Completed</option>
            </select>
        </div>

         <!--  Priority filter -->
        <div class="mb-3">
            <label>Priority</label>
            <select wire:model="priority" class="form-select">
                <option value="">All</option>
                <option value=0 data-imagesrc="/static/images/low.png">Low</option>
                <option value=1>Medium</option>
                <option value=2>High</option>
                <option value=3>Critical</option>
            </select>
        </div>

        <!--  Type filter -->
        <div class="mb-3">
            <label>Type</label>
            <select wire:model="task_type" class="form-select">
                <option value="">All</option>
                <option value="bug">Bug</option>
                <option value="feature">Feature</option>
                <option value="task">Task</option>
            </select>
        </div>
    </div>
</div>

<!-- <img src="/static/images/low.png"> -->