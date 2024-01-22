<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::with('category','assignedTask')->filter($request)->paginate(10);
        return $tasks;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->category_id = $request->category_id;

        if ($request->file) {
            $path = Storage::putFile('public', $request->file);
            $link = env('APP_URL') . Storage::url($path);
            $task['url']=$link;
        }

        $task->save();
        return 'success';
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::find($id);
        return $task;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $task->title = $request->title ?? $task->title;
        $task->description = $request->description ?? $task->description;
        $task->category_id = $request->category_id ?? $task->category_id;

        if ($request->file) {
            $path = Storage::putFile('public', $request->file);
            $link = env('APP_URL') . Storage::url($path);
            $task['url']=$link;
        }

        $task->save();
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return 'delete success';

    }

    public function restore($id)
    {
        $task = Task::withTrashed()->find($id);
        $task->restore();
        return 'success';

    }
}
