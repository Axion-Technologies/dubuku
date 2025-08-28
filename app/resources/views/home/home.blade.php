<h3 class="mt-5">&#x1F44B; Hello {{ Auth::user()->first_name.' '.Auth::user()->last_name }}</h3>
<br><br>
<div class="row">
    <div class="col-md-9 justify-content-center">
        <h2>My Tasks</h2><br>
        display tasks
        
    </div>
    <!-- Card starts -->
    <div class="col-md-3 justify-content-center">
        <div class="card text-center custom-card shadow-sm">
            <div class="card-body p-3">
                <a href="/tasks">
                    <h5 class="card-title mb-0">Tasks</h5>
                </a>
            </div>
        </div>
        <hr>
        <div class="card text-center custom-card shadow-sm">
            <div class="card-body p-3">
                <a href="/projects">
                    <!-- <img src="/static/images/bank.png" class="card-image img-fluid mb-3"> -->
                    <h5 class="card-title mb-0">Projects</h5>
                </a>
            </div>
        </div>
    </div>
    <!-- Card ends -->
</div>