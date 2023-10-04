<?php

namespace App\Models;

use App\Enums\TaskStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class Task extends Model
{
    use HasFactory, FilterQueryString;

    protected $table = 'tasks';

    protected $fillable = [
        'assignee_id',
        'title',
        'description',
        'deadline',
        'status',
    ];

    protected $filters = [
        'title',
        'greater_or_equal',
        'less_or_equal',
        'status'
    ];

    protected $casts = [
        'status' => TaskStatusEnum::class,
    ];

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id', 'id');
    }
}
