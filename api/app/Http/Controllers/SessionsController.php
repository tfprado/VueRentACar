<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Adldap\Laravel\Facades\Adldap;
use App\User;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        // Check database. If authentication fails try LDAP
        if (auth()->attempt(request(['username', 'password'])) == false)
        {
            // Check LDAP. If authentication fails redirect back with errors.
            if (Adldap::auth()->attempt(request('username'), request('password')) == false)
            {
                return back()->withErrors([
                'message' => 'The username or password is incorrect, please try again'
                ]);
            }

            // LDAP Authentication successful, create new user
            $userName = request('username');
            $userPassword = request('password');
            $ldapUser = Adldap::search()->users()->find($userName);
            // Get email attribute from LDAP server or create random email if needed (email field is required)
            if ($ldapUser->getAttribute('mail', 0) == null)
            {
                $userEmail = str_random(10).'@kensingtonhealth.org';
            }
            else
            {
                $userEmail= $ldapUser->getAttribute('mail', 0);
            }

            $user = new User();
            $user->username = $userName;
            $user->password = $userPassword;
            $user->email = $userEmail;
            $user->save();
            auth()->login($user);
        }

        return redirect()->to('/home');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->to('/');
    }
}
