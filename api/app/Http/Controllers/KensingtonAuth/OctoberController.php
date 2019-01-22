<?php

namespace App\Http\Controllers\KensingtonAuth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Adldap\Laravel\Facades\Adldap;
use App\OctoberBackendUser;
use App\Role;
use Validator;
use App\Http\Controllers\Controller;

class OctoberController extends Controller
{
    public function getDbUser(Request $request)
    {
        $rules = [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:3'
        ];
        $response = array('response' => '', 'success'=>false);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        }
        else
        {
            //process the request
            if (Auth::attempt(request(['username', 'password'])))
            {
                $login = request('username');
                $password = request('password');

                $user = new OctoberBackendUser();
                $user->login = $login;
                $user->password = $password;
                $user->email = "tpradoTest@gmail.com";
                // $user->save();
                dd($user);
                return response()->json([
                    "action" => "user found!",
                ]);
            }
            else
            {
                return response()->json([
                    'message' => 'The username or password is incorrect, please try again'
                ]);
            }
        }
        return $response;

    }

}
