<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'company_id'];

    protected $table = 'projects';

    public function users()
    {
        return $this->belongsToMany(Users::class, 'user_project_mapping', 'project_id', 'user_id')
                    ->withPivot('company_id')
                    ->withTimestamps();
    }

}
