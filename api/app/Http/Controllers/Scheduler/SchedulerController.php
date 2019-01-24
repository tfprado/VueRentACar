<?php

namespace App\Http\Controllers\Scheduler;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SchedulerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }


    public function index()
    {
        return view('scheduler');
    }
}
