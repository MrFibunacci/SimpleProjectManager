<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::view('/dashboard', 'dashboard')->middleware('auth')->name('dashboard');
Route::view('/projects', 'project.index')->middleware('auth')->name('projects');
Route::view('/project/create', 'project.create')->middleware('auth')->name('project.create');
Route::post('/project/store', [ProjectController::class, 'store'])->name('project.store');
Route::get('/project/{project}', [ProjectController::class, 'show'])->name('project.show');

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('task.create');
Route::post('/tasks/store', [TaskController::class, 'store'])->name('task.store');

Route::get('/settings')->name('settings');

Route::get('/status', [StatusController::class, 'index'])->name('status');
Route::get('/status/create', [StatusController::class, 'create'])->name('status.create');
Route::post('/status/store', [StatusController::class, 'store'])->name('status.store');
Route::get('/status/{status}/edit', [StatusController::class, 'edit'])->name('status.edit');
Route::patch('/status/{status}/update', [StatusController::class, 'update'])->name('status.update');
Route::delete('/status/destroy/{status}', [StatusController::class, 'destroy'])->name('status.destroy');
