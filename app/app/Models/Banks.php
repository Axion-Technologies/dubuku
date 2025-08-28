<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banks extends Model
{
    use HasFactory;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE   = 1;
    const STATUS_DELETE   = 2;

    protected $table = 'banks';

    protected $fillable = ['comp_id', 'user_id', 'bank_name', 'branch', 'account_holder_name', 'account_number', 'ifsc_code', 'account_type', 'phone_number', 'status'];
}
