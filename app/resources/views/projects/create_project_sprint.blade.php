<nav aria-label="breadcrumb">
	<h2>Create New Sprint</h2>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/workspace">My Workspace</a></li>
        <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
        <li class="breadcrumb-item"><a href="/projects/{{$project_id}}/work">Work</a></li>
        <li class="breadcrumb-item"><a href="/projects/{{$project_id}}/sprints">Sprints</a></li>
		<li class="breadcrumb-item active" aria-current="page">New</li>
	</ol>
</nav>
<hr class="mt-4" style="color: #cbcbcb;">
<br>
<!-- new sprint creation form -->
 <div id ="new-sprint">
    <div v-if="errorMessage" class="alert alert-danger">
        @{{ errorMessage }}
    </div>
    <div v-if="successMessage" class="alert alert-success">
        @{{ successMessage }}
    </div>
    <input type="hidden" ref="project_id" value="{{ $project_id }}">
    <div class="mb-3">
        <label>Title<font color="red">*</font></label>
         <input type="text" v-model="title" class="form-control">
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea type="text" v-model="description" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Start Date<font color="red">*</font></label>
        <input type="date" v-model="startDate" class="form-control">
    </div> 
    
    <div class="mb-3">
        <label>End Date<font color="red">*</font></label>
        <input type="date" v-model="endDate" class="form-control">
    </div> 

    <button type="button" class="btn home-btn" @click="createSprint">Create</button>
</div>

<script src="/static/js/app/new_sprint.js"></script>