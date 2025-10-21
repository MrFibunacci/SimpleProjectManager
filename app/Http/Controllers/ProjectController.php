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
        $role = (new Role())::find(1);

        Auth::user()->projects()->save($project);

        //TODO add the owner role to pivot table between project and user
    }
}
