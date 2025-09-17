<nav aria-label="breadcrumb">
	<h2>My Tasks</h2>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/home">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page"> My Tasks</li>
	</ol>
</nav>
<hr class="mt-4" style="color: #cbcbcb;">
<br>
<div class="row"> 
    <div class="row" id="tasks">
        <!-- Task Table -->
        <div class="col-md-9">
            <span v-if="showLoading === 'yes'"><h4>Loading....</h4></span>
            <span v-else>
                <div v-if="displayedTasks.length > 0" class="table-responsive">
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
                            <tr v-for="task in displayedTasks" :key="task.id" :class="task.row_class || ''">
                                <td>@{{ task.ticket_type }}</td>
                                <td><a :href="`/my-tasks/details/${task.id}`">@{{ task.heading }}</a></td>
                                <td>@{{ getPriorityLabel(task.priority) }}</td>
                                <td>@{{ getStatusLabel(task.status) }}</td>
                                <td>@{{ task.project_name }}</td>
                                <td>@{{ formatDate(task.created_at) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else>
                    <p><center>No task found</center></p>
                </div>
            </span>
        </div>
        <div class="col-md-3">
            <p align="right"><a href="/tasks/create"><button class="btn custom-btn"><i class="fa fa-plus me-2" aria-hidden="true"></i>Create Task</button></a></p>
            <br>
            <h4><b>Filters</b></h4>
            <select class="form-select" v-model.number="tempTicketPriority">
                <option disabled value="">Choose Priority</option>
                <option :value="0">Low</option>
                <option :value="1">Medium</option>
                <option :value="2">High</option>
                <option :value="3">Critical</option>
            </select>
            <br>
            <select class="form-select" v-model="tempProjectFilter">
                <option disabled value="">Choose Project</option>
                <option v-for="project in projects" :key="project.id" :value="project.id">
                    @{{ project.name }}
                </option>
            </select>
            <br>
            <p class="text-end">
                <button class="btn btn-secondary btn-sm" @click="clearFilter">Clear</button>
                <button class="btn custom-btn btn-sm" @click="applyFilter" :disabled="applyingFilter">Apply</button>
            </p>
            </div>
        </div>
    </div>
</div>

<script src="/static/js/app/tasks.js"></script>
