<nav aria-label="breadcrumb">
	<h2>{{ $project_name }} - Summary</h2>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/workspace">My Workspace</a></li>
        <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
        <li class="breadcrumb-item"><a href="/projects/{{$project_id}}/work">Work</a></li>
		<li class="breadcrumb-item active" aria-current="page">Summary</li>
	</ol>
</nav>
<hr class="mt-4" style="color: #cbcbcb;">
<br>
1. Project Details
<br>
Project name, key, type (Scrum, Kanban, or Classic).
<br>
Project lead and team members.
<br>
Project description and important links (like boards, backlog, or docs).
<br><br>
2. Issue Statistics / Quick Metrics
<br>
Total number of issues in the project.
<br>
Breakdown of issues by status: Open, In Progress, Done, etc.
<br>
Breakdown by priority: High, Medium, Low.
<br>
Breakdown by issue type: Bug, Task, Story, Epic.
<br>
Breakdown by assignee: How many issues each team member has.
<br><br>
3. Activity Stream / Recent Updates
<br>
List of recently created or updated issues.
<br>
Comments added or changes made.
<br>
Changes in issue status or assignments.
<br><br>
4. Progress Indicators
<br>
Charts or bars showing overall progress, e.g., how many issues are completed vs. total.
<br>
Sometimes a pie chart for quick visual summary of issue distribution by status, priority, or assignee.
<br><br>
5. Sprint / Board Quick Links (for Scrum projects)
<br>
Current active sprint summary.
<br>
Quick access to the backlog or board.
<br>
Progress bars for sprint completion.
<br><br>
6. Optional Gadgets / Panels (if Jira admin configures)
<br>
Calendar view of due dates.
<br>
Quick filters for issues.
<br>
Any custom dashboard widgets showing key project metrics.
<br><br>