<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;

use App\Task;
use App\Http\Controllers\Controller;

class CompletedTasksController extends Controller
{
    public function store(Task $task)
    {
        $task->complete();
        return back();
    }

    public function destroy(Task $task)
    {
        $task->incomplete();
        return back();
    }

}
