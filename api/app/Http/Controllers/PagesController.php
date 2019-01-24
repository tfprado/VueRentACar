<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Inspiring;

class PagesController extends Controller
{
    public function home()
    {
        return view('welcome', [
            'foo' => Inspiring::quote()
        ]);

    }
}
