<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Type</th>
                <th>Title</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Project</th>
                <th>Created On</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $task)
            <tr class="{{ $task->row_class ?? '' }}">
                <td>{{ $task->ticket_type_label }}</td>
                <td><a href="/tasks/details/{{$task->id}}">{{ $task->heading }}</a></td>
                <td>{{ $task->priority_label }}</td>
                <td>{{ $task->status_label }}</td>
                <td>{{ $task->project_name ?? '-' }}</td>
                <td>{{ $task->created_at->format('d M Y, h:i A') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No tasks found.</td>
            </tr>
            @endforelse            

        </tbody>
    </table>

    <!-- Pagination links -->
    <div>
        {{ $tasks->links() }}
    </div>
</div>
