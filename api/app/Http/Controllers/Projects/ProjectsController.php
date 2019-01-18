<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Project;
use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');  // ->only(['store', 'update'])
                                    // ->except(['show'])
    }
    public function index()
    {
        // auth()->id();   // 4
        // auth()->user(); // User
        // auth()->check(); // Boolean
        // if(auth()->guest())
        $projects = Project::where('owner_id', auth()->id())->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create', compact('projects'));
    }

    public function show(Project $project)
    {
        abort_if($project->owner_id !== auth()->id(), 403); // Laravel help function
        // abort_if(! auth()->user()->owns($project), 403);     // Object oriented, add own method to user class
        // abort_unless( auth()->user()->owns($project), 403);


        // if (\Gate::denies('update', $project)) // or Gate::allows
        // {
            //     abort(403);
            // }

        // $this->authorize('update', $project); // With ProjectPolicy.php, registered on AuthServiceProvider.php

        return view('projects.show', compact('project'));
    }

    public function store ()
    {
        $attributes = request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
        ]);

        $attributes ['owner_id'] = auth()->id();
        Project::create($attributes);

        // Project::create (
        //     request()->validate([
        //         'title' => ['required', 'min:3'],
        //         'description' => ['required', 'min:3']
        //     ])
        // );

        return redirect('/projects');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        $this->authorize('update', $projects);

        $project->update(request(['title', 'description']));

        return redirect('/projects');
    }

    public function destroy(Project $project)
    {
        $this->authorize('update', $projects);

        $project->delete();

        return redirect('/projects');
    }

}
