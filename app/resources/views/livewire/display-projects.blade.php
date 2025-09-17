<div>
    <div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Project Details</th>
                    <th>Mapping</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $index => $project)
                <tr>
                    <td>{{ $project->name }}</td>
                    <td><a href="/admin/projects/details/{{ $project->id }}">View Details</a></td>
                    <td><a href="/admin/projects/user-mapping/{{ $project->id }}">Map Users</a></td>
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

