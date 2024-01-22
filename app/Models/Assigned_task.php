<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assigned_task extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
    'student_id',
    'task_id',
    'completed',
    'deadline',
    ];
    public function student()
    {
        return $this->hasOne(Student::class,'id','student_id');
    }

    public function task()
    {
        return $this->hasOne(Task::class,'id','task_id');
    }

    public function scopeFilter($query, $request)
    {
        return $query->when($request->student_id, function ($assignedTask, $student_id){
            return $assignedTask->where('student_id', $student_id);
        }
    )->when($request->task_id, function ($assignedTask, $task_id){
        return $assignedTask->where('task_id', $task_id);
    }
    )->when($request->completed, function ($assignedTask, $completed){
        return $assignedTask->where('completed', $completed);
    }
    )->when($request->deadline, function ($assignedTask, $deadline){
        return $assignedTask->where('deadline', $deadline);
    }
    );
    }

}


