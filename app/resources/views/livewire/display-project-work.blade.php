<nav aria-label="breadcrumb">
	<h2>{{ $project->name }} - Work</h2>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/workspace">My Workspace</a></li>
        <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
		<li class="breadcrumb-item active" aria-current="page">Work</li>
	</ol>
</nav>
<hr class="mt-4" style="color: #cbcbcb;">
<br>
<p><a href="/projects/{{$project_id}}/summary">Summary</a></p>
<p><a href="/projects/{{$project_id}}/reports">Reports</a></p>
<p><a href="/projects/{{$project_id}}/sprints">Sprints</a></p>
<p><a href="/projects/{{$project_id}}/issues">All Work</a></p>
