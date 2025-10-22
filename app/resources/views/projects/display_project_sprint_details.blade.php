<nav aria-label="breadcrumb">
	<h2>Project Sprint Details</h2>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/workspace">My Workspace</a></li>
        <li class="breadcrumb-item"><a href="/projects">Projects</a></li>
        <li class="breadcrumb-item"><a href="/projects/{{$project_id}}/work">Work</a></li>
        <li class="breadcrumb-item"><a href="/projects/{{$project_id}}/sprints">Sprints</a></li>    
		<li class="breadcrumb-item active" aria-current="page">Sprint Details</li>
	</ol>
</nav>
<hr class="mt-4" style="color: #cbcbcb;">
<br>
<div id="sprint-details" data-project-id="{{ $project_id }}" data-sprint-id="{{ $sprint_id }}">
    <div v-if="sprintDetails && sprintDetails.title">
        <div class="row">
            <div class="col-md-6">

                <div class="row mb-3">
                    <div class="col-6 col-md-4"><b>Sprint ID :</b></div>
                    <div class="col-6 col-md-8">@{{ sprintDetails.id }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-6 col-md-4"><b>Sprint Title :</b></div>
                    <div class="col-6 col-md-8">@{{ sprintDetails.title }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-6 col-md-4"><b>Start Date :</b></div>
                    <div class="col-6 col-md-8">@{{ formatDate(sprintDetails.start_date) }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-6 col-md-4"><b>End Date :</b></div>
                    <div class="col-6 col-md-8">@{{ formatDate(sprintDetails.end_date) }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-6 col-md-4"><b>Status :</b></div>
                    <div class="col-6 col-md-8">
                        <span v-if="sprintDetails.status === 0">Draft</span>
                        <span v-else-if="sprintDetails.status === 1">Live</span>
                        <span v-else-if="sprintDetails.status === 2">Cancelled</span>
                        <span v-else>Finished</span>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="isDraft">
            <div class="row">
                <div class="col d-flex">
                    <button type="button" class="btn btn-success me-2" @click="goLive">Go Live</button>
                    <button type="button" class="btn btn-secondary" @click="cancelSprint">Cancel</button>
                </div>
            </div>
        </div>

        <!-- End Sprint -->
        <div v-if="isLive" @click="endSprint">
            <div class="row">
                <div class="col d-flex">
                    <button type="button" class="btn btn-danger">End Sprint</button>
                </div>
            </div>
        </div>
    </div>

    <div v-else>
        <p>@{{ errorMessage || 'Sprint details not found.' }}</p>
    </div>
</div>

<script src="/static/js/app/sprint_details.js"></script>


