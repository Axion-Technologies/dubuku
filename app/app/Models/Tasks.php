<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    const STATUS_NEW = 'new';
    const STATUS_INPROGRESS = 'inprogress';
    const STATUS_ONHOLD = 'onhold';
    const STATUS_COMPLETED = 'completed';
    const STATUS_DELETED = 'deleted';

    const PRIORITY_LOW = 0;
    const PRIORITY_MEDIUM = 1;
    const PRIORITY_HIGH = 2;
    const PRIORITY_CRITICAL = 3;

    protected $table = 'tasks';

    protected $fillable = ['company_id', 'created_by', 'heading', 'description', 'status', 'project_id', 'ticket_type', 'created_on', 'priority'];

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
            'bug' => 'Bug',
            'feature' => 'Feature',
            'task' => 'Task',
        ];

        return $statuses[$this->ticket_type] ?? 'Bug1';
    }


    public function getRowClassAttribute()
    {
        $classes = [
            'bug' => 'table-danger',      // Bootstrap red
            'feature' => 'table-info',    // Bootstrap blue
            'task' => 'table-success',    // Bootstrap green
        ];

        return $classes[$this->ticket_type] ?? '';
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }


}
