<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sprints extends Model
{
    use HasFactory;

    const STATUS_DRAFT = 0;
    const STATUS_LIVE = 1;
    const STATUS_CANCELLED = 2;
    const STATUS_FINISHED = 3;

    protected $table = 'sprints';

    protected $fillable = ['company_id', 'project_id', 'title', 'start_date', 'end_date'];

}
