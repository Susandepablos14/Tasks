<?php

use App\Http\Controllers\AssignedTaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/students', [StudentController::class, 'index']);
Route::post('/student', [StudentController::class, 'store']);
Route::get('/student/{id}', [StudentController::class, 'show']);
Route::put('/student/{id}', [StudentController::class, 'update']);
Route::delete('/student/{id}', [StudentController::class, 'destroy']);
Route::get('/student/restore/{id}', [StudentController::class, 'restore']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/category', [CategoryController::class, 'store']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::put('/category/{id}', [CategoryController::class, 'update']);
Route::delete('/category/{id}', [CategoryController::class, 'destroy']);
Route::get('/category/restore/{id}', [CategoryController::class, 'restore']);

Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/task', [TaskController::class, 'store']);
Route::get('/task/{id}', [TaskController::class, 'show']);
Route::put('/task/{id}', [TaskController::class, 'update']);
Route::delete('/task/{id}', [TaskController::class, 'destroy']);
Route::get('/task/restore/{id}', [TaskController::class, 'restore']);

Route::get('/assigned/tasks', [AssignedTaskController::class, 'index']);
Route::post('/assigned/task', [AssignedTaskController::class, 'store']);
Route::get('/assigned/task/{id}', [AssignedTaskController::class, 'show']);
Route::put('/assigned/task/{id}', [AssignedTaskController::class, 'update']);
Route::delete('/assigned/task/{id}', [AssignedTaskController::class, 'destroy']);
Route::get('/assigned/task/restore/{id}', [AssignedTaskController::class, 'restore']);
Route::put('/assigned/task/{id}/completed', [AssignedTaskController::class, 'completedTask']);


