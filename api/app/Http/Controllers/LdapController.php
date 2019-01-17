<?php

namespace App\Http\Controllers;

use App\KensingtonUser;
use Illuminate\Http\Request;
use Adldap\Laravel\Facades\Adldap;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LdapController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ldap');
    }

    public function login()
    {
        $credentials = [
            'username' => request('username'),
            'password' => request('password'),
        ];
        // $ldapUser = Adldap::search()->users()->find($credentials['username']);
        // dd($ldapUser);
        if (Adldap::auth()->attempt(request('username'), request('password')))
        {
            dd('Sucess!');
            $ldapUser = Adldap::search()->users()->find($credentials['username']);
            $userName = $credentials['username'];
            $userPassword = $credentials['password'];
            if ($ldapUser->getAttribute('mail', 0) == null)
            {
                $userEmail = 'noemail@gmail.com';
            }
            else
            {
                $userEmail= $ldapUser->getAttribute('mail', 0);
            }

            $user = new User();
            $user->username = $userName;
            // $user->password = Hash::make($userPassword);
            $user->password = $userPassword;
            $user->email = $userEmail;
            if (auth()->login($user))
            {
                dd($user);
            }
            else
            {
                dd('no login');
            }
            // $user->save();
            // $user = User::create([$userName, $userEmail, $userPassword]);

            // auth()->login($user);
        }

        dd('failed authentication');
        return view('ldap');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KensingtonUser  $kensingtonUser
     * @return \Illuminate\Http\Response
     */
    public function show(KensingtonUser $kensingtonUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KensingtonUser  $kensingtonUser
     * @return \Illuminate\Http\Response
     */
    public function edit(KensingtonUser $kensingtonUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KensingtonUser  $kensingtonUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KensingtonUser $kensingtonUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KensingtonUser  $kensingtonUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(KensingtonUser $kensingtonUser)
    {
        //
    }
}
