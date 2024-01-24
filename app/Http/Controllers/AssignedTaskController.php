<?php

namespace App\Http\Controllers;

use App\Models\Assigned_task;
use App\Http\Requests\StoreAssigned_taskRequest;
use App\Http\Requests\UpdateAssigned_taskRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssignedTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $assigned_tasks = Assigned_task::with('student', 'task.category')->filter($request)->paginate(10);
        return $assigned_tasks;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $assigned_task = new Assigned_task;
        $assigned_task->student_id = $request->student_id;
        $assigned_task->task_id = $request->task_id;
        $assigned_task->completed= $request->completed;
        $assigned_task->deadline = $request->deadline;

        $assigned_task->save();
        return 'success';

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $assigned_task = Assigned_task::find($id);
        return $assigned_task;

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $assigned_task = Assigned_task::find($id);
        $assigned_task->student_id = $request->student_id ?? $assigned_task->student_id;
        $assigned_task->task_id = $request->task_id ?? $assigned_task->task_id;
        $assigned_task->completed = $request->completed ?? $assigned_task->completed;
        $assigned_task->deadline = $request->deadline ?? $assigned_task->completed;

        $assigned_task->save();
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $assigned_task = Assigned_task::find($id);
        $assigned_task->delete();
        return 'delete success';
    }

    public function restore($id)
    {
        $assigned_task = Assigned_task::withTrashed()->find($id);
        $assigned_task->restore();
        return 'success';
    }

    public function completedTask(Request $request, $id)
    {
        $assigned_task = Assigned_Task::find($id);
        $deadline = $assigned_task->deadline;
        $now = Carbon::now()->format('Y-m-d');
        $completed = $assigned_task->completed;

        if ($completed) {
            return 'La tarea ya fue completada';
        } elseif ($now <= $deadline) {
                $assigned_task->completed = $request->completed ?? $assigned_task->completed;
                $assigned_task->save();
                return 'La tarea ha sido actualizada';
        } else {
            return 'La tarea no puede ser completada porque ya pasó la fecha límite';
        }
    }


}
