<?php

namespace App\Http\Controllers\KensingtonAuth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Adldap\Laravel\Facades\Adldap;
use App\User;
use App\Http\Controllers\Controller;

class SessionsController extends Controller
{

    public function setLoginType()
    {
        $loginType = request()->input();

        if (array_key_exists("adlogin",$loginType))
        {
            return back()->with('Login Type', 'ad');
        }
        else if (array_key_exists("locallogin",$loginType))
        {
            return back()->with('Login Type', 'local');
        }
        return back();
        dd($loginType);
    }

    public function searchAd()
    {
        $credentials = $this->validateInput();

        // check if LDAP authentication fails
        if (Adldap::auth()->attempt($credentials['username'], $credentials['password']) == false)
        {
            return back()->withErrors([
            'message' => 'The username or password is incorrect, please try again'
            ]);
        }

        // check if local user already exists for Ad user
        if (Auth::attempt($credentials))
        {
            // return redirect()->to('/home');
            return redirect()->intended('/home');
        }

        // LDAP Authentication successful but no local user, create new one
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

        return redirect()->intended('/home');
    }

    public function getDbUser()
    {
        $credentials = $this->validateInput();

        if (Auth::attempt($credentials))
        {
            // return redirect()->to('/home');
            return redirect()->intended('/home');
        }
        else
        {
            return back()->withErrors([
                'message' => 'The username or password is incorrect, please try again'
            ]);
        }
    }

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

    protected function validateInput()
    {
        return request()->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required', 'min:3']
        ]);
    }
}
