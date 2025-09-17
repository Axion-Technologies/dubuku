<nav aria-label="breadcrumb">
	<h2>Tasks</h2>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
		<li class="breadcrumb-item active" aria-current="page">Tasks</li>
	</ol>
</nav>
<hr class="mt-4" style="color: #cbcbcb;">
<br>
@livewire('display-project-tasks', ['project_id' => $project_id])
