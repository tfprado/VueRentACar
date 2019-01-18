<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;

use App\Task;
use App\Project;
use App\Http\Controllers\Controller;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
        // Task::create([
        //     'project_id' => $project->id,
        //     'description' => request('description')
        // ]);
        
        $attributes = request()->validate(['description' => 'required']);

        $project->addTask($attributes);

        return back();
    }
}
