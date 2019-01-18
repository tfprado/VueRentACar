<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Project;
use App\Http\Controllers\Controller;
use App\Mail\ProjectCreated;
use Illuminate\Support\Facades\Mail;

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


        // $projects = Project::where('owner_id', auth()->id())->get();
        // same as
        // $projects = auth()->user()->projects;

        // dump($projects); can be seen in /telescope under the dump tab

        // Storing things in cache
        // cache()->rememberForever('stats', function (){
        //     return ['appointments' => 100, 'hours' => 50000];
        // });

        // return view('projects.index', compact('projects'));

        // all together
        return view('projects.index', [
            'projects' => auth()->user()->projects
        ]);
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
        $attributes = $this->validateProject();

        $attributes ['owner_id'] = auth()->id();
        $project = Project::create($attributes);

        // Project::create (
        //     request()->validate([
        //         'title' => ['required', 'min:3'],
        //         'description' => ['required', 'min:3']
        //     ])
        // );

        // Example of sending email after successful project creation
        // php artisan make:mail ProjectCreated --markdown="mail.project-created"
        // Mail::to($project->owner->email)->send(
        //     new ProjectCreated($project)
        // );

        return redirect('/projects');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {

        $this->authorize('update', $project);

        $project->update($this->validateProject());

        return redirect('/projects');
    }

    public function destroy(Project $project)
    {
        $this->authorize('update', $project);

        $project->delete();

        return redirect('/projects');
    }

    protected function validateProject()
    {
        return request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
        ]);
    }
}
