<?php

namespace App\Http\Controllers\KensingtonAuth;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed'
        ]);



        $user = User::create(request(['username', 'email', 'password']));

        $user->roles()->attach(Role::where('name', 'local')->first());

        auth()->login($user);

        return redirect()->to('/home');
    }
}
