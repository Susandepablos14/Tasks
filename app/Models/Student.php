<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'number_document',
        'birthdate',
    ];

    public function assignedTask()
    {
        return $this->hasMany(Assigned_task::class,'student_id','id');
    }

    public function scopeFilter($query, $request)
    {
        return $query->when($request->name, function ($students, $name){
            return $students->where('name', $name);
        }
    )->when($request->last_name, function ($students, $last_name){
        return $students->where('last_name', $last_name);
    }
    )->when($request->email, function ($students, $email){
        return $students->where('email', $email);
    }
    )->when($request->number_document, function ($students, $number_document){
        return $students->where('number_document', $number_document);
    }
    )->when($request->birthdate, function ($students, $birthdate){
        return $students->where('birthdate', $birthdate);
    }
    );
    }



}
