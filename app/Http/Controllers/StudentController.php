<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = Student::with('assignedTask')->filter($request)->paginate(10);
        return $students;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = new Student();
        $student->name = $request->name;
        $student->last_name = $request->last_name;
        $student->email = $request->email;
        $student->number_document = $request->number_document;
        $student->birthdate = $request->birthdate;

        $student->save();
        return 'success';
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::find($id);
        return $student;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $student->name = $request->name ?? $student->name;
        $student->last_name = $request->last_name ?? $student->last_name;
        $student->email = $request->email ?? $student->email;
        $student->number_document = $request->number_document ?? $student->number_document;
        $student->birthdate = $request->birthdate ?? $student->birthdate;

        $student->save();
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return 'delete success';
    }

    public function restore($id)
    {
        $student = Student::withTrashed()->find($id);
        $student->restore();
        return 'delete success';
    }
}
