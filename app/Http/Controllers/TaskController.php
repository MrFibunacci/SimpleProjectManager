<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|View
    {
        return view('task.index', ['tasks' => []]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(\Illuminate\Http\Request $request): View
    {
        if ($request->get('project') !== null) {
            $projects = Auth::user()->projects()->where('id', $request->get('project'))->get();
        } else {
            $projects = Auth::user()->projects;
        }

        return view('task.create', ['projects' => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = new Task($request->validated());

        if (Auth::user()->cannot('create', [$task])) {
            abort(403);
        }

        $task->save();

        return to_route('project.tasks', $task->project)->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task): Factory|View
    {
        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task): Factory|View
    {
        return view('task.edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
