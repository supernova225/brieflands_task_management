<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'assignee_id',
        'title',
        'description',
        'deadline',
        'status',
    ];

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }
}
