<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function store(StoreProjectRequest $request)
    {
        $project = new Project($request->validated());
        $project->save();

        $role = Role::where('name', 'Owner')->first();
        Auth::user()->projects()->attach($project, ['role_id' => $role->id]);

        return redirect()->route('projects');
    }
}
