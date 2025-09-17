<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    const STATUS_NEW        = 0;
    const STATUS_TODO       = 0;
    const STATUS_INPROGRESS = 1;
    const STATUS_ONHOLD     = 2;
    const STATUS_COMPLETED  = 3;
    const STATUS_DELETED    = 4;
    const STATUS_MERGED     = 5;
    const STATUS_IN_REVIEW  = 6;

    const PRIORITY_LOW      = 0;
    const PRIORITY_MEDIUM   = 1;
    const PRIORITY_HIGH     = 2;
    const PRIORITY_CRITICAL = 3;

    protected $table = 'tasks';

    protected $fillable = ['company_id', 'created_by', 'heading', 'description', 'status', 'project_id', 'ticket_type', 'created_on', 'priority'];

    protected $appends = [
        'priority_label',
        'status_label',
        'ticket_type_label',
        'row_class',
    ];

    public function getPriorityLabelAttribute()
    {
        $labels = [
            0 => 'Low',
            1 => 'Medium',
            2 => 'High',
            3 => 'Critical',
        ];

        return $labels[$this->priority] ?? 'Low';
    }


    public function getStatusLabelAttribute()
    {
        $statuses = [
            0 => 'New',
            1 => 'In Progress',
            2 => 'On Hold',
            3 => 'Completed',
            4 => 'Deleted',
            5 => 'Merged',
        ];

        return $statuses[$this->status] ?? 'Unknown';
    }

    public function getTicketTypeLabelAttribute()
    {
        $statuses = [
            'bug'     => 'Bug',
            'feature' => 'Feature',
            'task'    => 'Task',
            'improvement' => 'Improvement'
        ];

        return $statuses[$this->ticket_type] ?? 'Bug';
    }


    public function getRowClassAttribute()
    {
        $classes = [
            'bug'     => 'table-danger',      // Bootstrap red
            'feature' => 'table-info',    // Bootstrap blue
            'task'    => 'table-success',    // Bootstrap green
        ];

        return $classes[$this->ticket_type] ?? '';
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }


}
