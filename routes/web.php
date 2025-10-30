<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::view('/dashboard', 'dashboard')->middleware('auth')->name('dashboard');
Route::view('/projects', 'project.index')->middleware('auth')->name('projects');
Route::view('/project/create', 'project.create')->middleware('auth')->name('projects.create');
Route::post('/project/store', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/tasks')->name('tasks');
Route::get('/settings')->name('settings');

Route::get('/status', [StatusController::class, 'index'])->name('status');
Route::get('/status/create', [StatusController::class, 'create'])->name('status.create');
Route::post('/status/store', [StatusController::class, 'store'])->name('status.store');
Route::get('/status/{status}/edit', [StatusController::class, 'edit'])->name('status.edit');
Route::delete('/status/destroy/{status}', [StatusController::class, 'destroy'])->name('status.destroy');
