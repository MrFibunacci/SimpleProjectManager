<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $project = new Project($request->validated());
        $project->status()->associate(Status::find($request->validated('status')));
        $project->save();

        $role = Role::where('name', 'Owner')->first();
        Auth::user()->projects()->attach($project, ['role_id' => $role->id]);

        return redirect()->route('projects');
    }

    public function show(Project $project):  Factory|View
    {
        return view('project.show', ['project' => $project]);
    }

    public function tasks(Project $project, Request $request): View
    {
        if($request->get('show') == 'all') {
            $tasks = $project->tasks()->orderBy('due_date')->get();
        } else {
            $tasks = $project->tasks()->where('completed', null)->orderBy('due_date')->get();
        }

        return view('project.tasks', ['project' => $project, 'tasks' => $tasks]);
    }

    public function settings(Project $project)
    {
        return view('project.settings', ['project' => $project]);
    }
}
