<div>
    @if ($project_details)
    <div class="row">
        <div class="col-md-6 vertical-right">
            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Project Name :</b></div>
                <div class="col-6 col-md-8">{{ $project_details->name }}</div>
            </div>
          
            <div class="row mb-3">
                <div class="col-6 col-md-4"><b>Created On :</b></div>
                <div class="col-6 col-md-8">{{ $project_details->created_at->format('d M Y, h:i A') }}</div>
            </div>
        </div>
    </div>
    @else
        <p>Project Details not found</p>
    @endif
</div>
