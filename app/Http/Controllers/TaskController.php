<?php

namespace App\Http\Controllers;

use App\Enum\Task as TaskEnum;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
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
    public function create(Request $request): View
    {
        if ($request->get('project') !== null) {
            $projects = Auth::user()->projects()->where('id', $request->get('project'))->get();
        } else {
            $projects = Auth::user()->projects;
        }

        return view('task.create', ['projects' => $projects, 'statuses' => Status::all()]);
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
        $task->status()->associate(Status::find($request->validated('status_id')));

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
    public function edit(Task $task): View
    {
        return view('task.edit', [
            'task' => $task,
            'projects' => $task->project()->get(),
            'tasks' => $task->project->tasks,
            'statuses' => Status::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        if (Auth::user()->cannot('update', [$task])) {
            abort(403);
        }

        $task->status()->associate(Status::find($request->validated('status_id')));

        $parent_task_id = $request->validated('parent_task_id');
        if ($parent_task_id !== null) {
            $task->parent_task()->associate($parent_task_id);
        } else {
            $task->parent_task()->dissociate();
        }

        $task->update($request->validated());

        return to_route('task.show', $task)->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
