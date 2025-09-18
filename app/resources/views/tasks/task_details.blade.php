<nav aria-label="breadcrumb">
	<h2>Issue Details</h2>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/home">Home</a></li>
		<li class="breadcrumb-item"><a href="/projects/{{$project_id}}/work">Work</a></li>
		<li class="breadcrumb-item"><a href="/projects/{{$project_id}}/issues">Issues</a></li>
		<li class="breadcrumb-item active" aria-current="page">Details</li>
	</ol>
</nav>
<hr class="mt-4" style="color: #cbcbcb;">
<br>
@livewire('task-details', ['project_id' => $project_id, 'task_id' => $task_id])
