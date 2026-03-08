<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocRequest;
use App\Http\Requests\UpdateDocRequest;
use App\Models\Doc;
use App\Models\Project;

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
        return view('docs.index', ['project' => $project, 'docs' => $project->docs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $project)
    {
        return view('docs.create', ['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Doc $doc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doc $doc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocRequest $request, Doc $doc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doc $doc)
    {
        //
    }
}
