<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_DELETE   = 3;

    const ROLE_USER    = 1;
    const ROLE_MANAGER = 2;
    const ROLE_ADMIN   = 3;

    protected $table = 'users';

    protected $fillable = ['comp_id', 'first_name', 'last_name', 'email', 'password', 'status', 'user_role'];

    protected $hidden = ['password'];

    public function projects()
    {
        return $this->belongsToMany(Projects::class, 'user_project_mapping', 'user_id', 'project_id')
                    ->withTimestamps();
    }

}
