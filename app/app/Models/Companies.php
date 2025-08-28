<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    const  STATUS_UNCONFIRMED = 0;
    const  STATUS_ACTIVE      = 1;
    const  STATUS_INACTIVE    = 2;
    const  STATUS_DELETED     = 3;

    protected $table = 'companies';

    protected $fillable = ['first_name', 'last_name', 'comp_name', 'email', 'confirmation_code', 'status'];
}
