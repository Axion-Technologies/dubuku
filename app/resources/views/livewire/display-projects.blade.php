<div>
    <div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Project Details</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $index => $project)
                <tr>

                    <td>{{ $project->name }}</td>
                    <td><a href="/admin/projects/details/{{ $project->id }}">View Details</a></td>
                    
                </tr>
                @empty
                <tr>
                    <td colspan="7">No projects found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</div>

