<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/projects', 'project.index')->name('projects');
Route::get('/tasks')->name('tasks');
Route::get('/settings')->name('settings');
