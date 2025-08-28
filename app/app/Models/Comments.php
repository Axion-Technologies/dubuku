<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    const STATUS_PUBLISHED = 'published';
    const STATUS_DELETED = 'deleted';

    const PUBLIC_YES = 'yes';
    const PUBLIC_NO = 'no';

    protected $table = 'comments';

    protected $fillable = ['task_id', 'company_id', 'created_by', 'created_on', 'comment'];

    protected $casts = [
        'created_on' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
