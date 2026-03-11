<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocRequest;
use App\Http\Requests\UpdateDocRequest;
use App\Models\Doc;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class DocController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        if ($project->docs->count() > 0) {
            return redirect()->route('docs.show', [$project, 'doc' => $project->docs->first()]);
        }

        return view('docs.index', ['project' => $project, 'docs' => $project->docs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        return view('docs.create', ['project' => $project, 'docs' => $project->docs]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocRequest $request, $project)
    {
        // NOTE: for a reason unknown to me, if I use dependency injection on the method here
        // I receive an HTML 404 error despite the resource exiting. So this is a fix for that until I
        // figure out what went wrong
        $project = Project::find($project);

        $data = $request->validated();

        $project->docs()->save(new Doc($data));

        return redirect()->route('project.docs', ['project' => $project, 'docs' => $project->docs]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project,Doc $doc)
    {
        return view('docs.show', ['project' => $project, 'docs' => $project->docs, 'doc' => $doc]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project, Doc $doc)
    {
        return view('docs.edit', ['project' => $project, 'docs' => $project->docs, 'doc' => $doc]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocRequest $request, Project $project,Doc $doc)
    {
        $doc->update($request->validated());

        return redirect()->route('docs.show', [
            'project' => $project,
            'docs' => $project->docs,
            'doc' => $doc
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, Doc $doc)
    {
        if (Auth::user()->can('delete', $doc)) {
            $doc->delete();
        }

        return redirect()->route('project.docs', ['project' => $project, 'docs' => $project->docs]);
    }
}
