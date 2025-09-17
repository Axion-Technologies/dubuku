<h3 class="mt-5">&#x1F44B; Hello {{ Auth::user()->first_name.' '.Auth::user()->last_name }}</h3>
<br><br>
<div class="row">
    <div class="col-md-9 justify-content-center">
        <h2>My Tasks</h2><br>
        <div class="row" id="tasks">
            <span v-if="showLoading === 'yes'"><h4>Loading....</h4></span>
            <span v-else>
            <!-- Tasks Table -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div v-if="topTasks.length > 0" class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
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
                                    <tr v-for="task in topTasks" :key="task.id" :class="task.row_class || ''">
                                        <td>@{{ task.ticket_type }}</td>
                                        <td>
                                            <a :href="`/my-tasks/details/${task.id}`">@{{ task.heading }}</a>
                                        </td>
                                        <td>@{{ getPriorityLabel(task.priority) }}</td>
                                        <td>@{{ getStatusLabel(task.status) }}</td>
                                        <td>@{{ task.project_name }}</td>
                                        <td>@{{ formatDate(task.created_at) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else>
                            <p>No tasks found.</p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <p align="right"><a href="my-tasks"><button class="btn custom-btn">View All <i class="fa-solid fa-angle-right area-hidden=true"></i></button></a></p>
            <br>
        </div>   
    </div>
    <!-- Card starts -->
    <div class="col-md-3 justify-content-center">
        <div class="card text-center custom-card shadow-sm mb-4 custom-btn">
            <div class="card-body p-3">
                <a href="/tasks" class="text-white text-decoration-none">
                    <h5 class="card-title mb-0">Tasks</h5>
                </a>
            </div>
        </div>
    
        <div class="card text-center custom-card shadow-sm mb-4 custom-btn">
            <div class="card-body p-3">
                <a href="/projects" class="text-white text-decoration-none">
                    <h5 class="card-title mb-0">Projects</h5>
                </a>
            </div>
        </div>
    
        <div class="card text-center custom-card shadow-sm mb-4 custom-btn">
            <div class="card-body p-3">
                <a href="/sprints" class="text-white text-decoration-none">
                    <h5 class="card-title mb-0">Sprints</h5>
                </a>
            </div>
        </div>
    </div>
    <!-- Card ends -->
</div>

<script src="/static/js/app/home.js"></script>
