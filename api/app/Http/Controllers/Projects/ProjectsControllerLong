<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Project;
use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create', compact('projects'));
    }
    
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }


    public function edit($id) 
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));        
    }

    public function update($id)
    {
        $project = Project::findOrFail($id);

        $project->title = request('title');
        $project->description = request('description');

        $project->save();
        
        return redirect('/projects');
    }

    public function destroy($id)
    {
        Project::findOrFail($id)->delete();
        return redirect('/projects');
    }

    public function store () 
    {
        $project = new Project();

        $project->title = request('title');
        $project->description = request('description');
        $project->save();

        return redirect('/projects');
    }
}
