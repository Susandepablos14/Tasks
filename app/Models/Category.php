<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
    'name',
    ];

    public function task()
    {
        return $this->belongsTo(task::class,'category_id','id');
    }

    public function scopeFilter($query, $request)
    {
        return $query->when($request->name, function ($category, $name){
            return $category->where('student_id', $name);
        }
    );
    }
}
