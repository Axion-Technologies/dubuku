<nav aria-label="breadcrumb">
	<h2>{{ $project_name }} - Sprint</h2>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/workspace">My Workspace</a></li>
        <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
        <li class="breadcrumb-item"><a href="/projects/{{$project_id}}/work">Work</a></li>
		<li class="breadcrumb-item active" aria-current="page">Sprints</li>
	</ol>
</nav>
<hr class="mt-4" style="color: #cbcbcb;">
<br>
<p align="right"><a class="btn btn-dark" href="/projects/{{$project_id}}/sprints/new">New Sprint</a></p>
<br>
<div id = "sprints" data-project-id="{{ $project_id }}">
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Task Count</th>
                </tr>
            </thead>
            <tbody v-if="sprints.length > 0">
                <tr v-for="(sprint, index) in sprints">    
                    <td><a :href="'/projects/' + projectId + '/sprints/details/' + sprint.id">@{{ sprint.title }}</a></td>
                    <td>@{{ formatDate(sprint.start_date) }}</td>
                    <td>@{{ formatDate(sprint.end_date) }}</td>
                    <td> 
                        <span v-if="sprint.status === 0">Draft</span>
                        <span v-else-if="sprint.status === 1">Live</span>
                        <span v-else-if="sprint.status === 2">Cancelled</span>
                        <span v-else>Finished</span>
                    </td>
                    <td>-</td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="6">No sprints found on this project.</td>
                </tr>
            </tbody>
        </table>
        <div>
        </div>
    </div>
</div>
<script src="/static/js/app/sprint.js"></script>