<?php namespace Kensington\Ldap\Components;

use CMS\Classes\ComponentBase;
use Input;
use Validator;
use Redirect;
use October\Rain\Auth\Manager;
use BackendAuth;
use Backend\Models\User;
use October\Rain\Network\Http;

use GuzzleHttp\Client;

class KensingtonLogin extends ComponentBase
{


    public function componentDetails(){

        return [
            'name' => 'Kensington Backend Login',
            'description' => 'Simple demo authentication'
        ];
    }

    public function onAuthUser(){

        $validator = Validator::make(
            [
                'username' => Input::get('username'),
                'password' => Input::get('password')
            ],
            [
                'username' => 'required',
                'password' => 'required'
            ]
        );

        if($validator->fails()){

            return Redirect::back()->withErrors($validator);
        }
        else{
            // $token='API key or token ';
            $request_url = 'http://localhost:80'; //.$token
            $client = new Client();
            $response = $client->request('POST', $request_url, [
                'username' => 'tprado',
                'password' => 'secret'
            ]);

            // $response = $client->request('POST', 'http://localhost:8080/api/october', [
            //     'form_params' => [
            //         'username' => 'tprado',
            //         'password' => 'secret'
            //     ]
            // ]);


            console.log($response);

        }
    }

}
