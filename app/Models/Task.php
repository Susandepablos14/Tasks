<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'url',
        'category_id',
    ];

    public function assignedTask()
    {
        return $this->belongsTo(Assigned_task::class,'task_id','id');
    }

    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function scopeFilter($query, $request)
    {
        return $query->when($request->title, function ($tasks, $title){
            return $tasks->where('title', $title);
        }
    )->when($request->description, function ($tasks, $description){
        return $tasks->where('description', $description);
    }
    )->when($request->url, function ($tasks, $url){
        return $tasks->where('url', $url);
    }
    )->when($request->category_id, function ($tasks, $category_id){
        return $tasks->where('category_id', $category_id);
    }
    );
    }

}
