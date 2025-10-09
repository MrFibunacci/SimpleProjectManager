<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::view('/home', 'home')->name('home');
Route::view('/projects', 'project.index')->name('projects');
Route::get('/tasks')->name('tasks');
