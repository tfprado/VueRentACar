<?php namespace Kensington\Ldap\Components;

use CMS\Classes\ComponentBase;
use Input;
use Validator;
use Redirect;
use October\Rain\Auth\Manager;
use BackendAuth;
use Backend\Models\User;

class KensingtonLogin extends ComponentBase
{
    public function componentDetails(){

        return [
            'name' => 'Kensington Backend Login',
            'description' => 'Simple demo authentication'
        ];
    }

    public function onSend(){

        $validator = Validator::make(
            [
                'name' => Input::get('name'),
                'password' => Input::get('password')
            ],
            [
                'name' => 'required',
                'password' => 'required'
            ]
        );

        if($validator->fails()){

            return Redirect::back()->withErrors($validator);
        }
        else{
            
            $ad = new Adldap\Adldap();
            
            $config = [
                'hosts'            => ['ldap', 'docktober_ldap_test', 'localhost'],
                'base_dn'          => 'dc=planetexpress,dc=com',
                'username'         => 'cn=admin,dc=planetexpress,dc=com',
                'password'         => 'GoodNewsEveryone',

                // Optional Configuration Options
                'schema'           => Adldap\Schemas\OpenLDAP::class,
                'account_prefix'   => 'cn=',
                'account_suffix'   => ',ou=people,dc=planetexpress,dc=com',
                'port'             => 389,
                'follow_referrals' => false,
                'use_ssl'          => false,
                'use_tls'          => false,
                'version'          => 3,
                'timeout'          => 5,

                // Custom LDAP Options
                'custom_options' => [
                // See: http://php.net/ldap_set_option
                //LDAP_OPT_X_TLS_REQUIRE_CERT => LDAP_OPT_X_TLS_HARD
                ]
            ];
            $connectionName = 'ldap-test';

            $ad->addProvider($config, $connectionName);
            $username = Input::get('name');
            $password = Input::get('password');
            $email = Input::get('email');

            try
            {
                $provider = $ad->connect($connectionName);
                
                    if ($provider->auth()->attempt($username, $password)) 
                    {
                        // Passed.
            
                        $userExists = BackendAuth::findUserByLogin($username);
                        if($userExists)
                        {
                            $user = BackendAuth::authenticate([
                                'login' => $username,
                                'password' => $password
                            ]);
                            return Redirect::to('/backend');
                        }
                        else
                        {
                            $userRegister = BackendAuth::register([
                                'login' => $username,
                                'email' => $email,
                                'password' => $password,
                                'password_confirmation' => $password,
                                'role' => '3'
                            ]);
                            $user = BackendAuth::authenticate([
                                'login' => $username,
                                'password' => $password
                            ]);
                            return Redirect::to('/backend');
                        }
                    } 
                    else 
                    {
                        // Failed.
                        return Redirect::to('/');
                    }
            } 
            catch (Adldap\Auth\BindException $e) 
            {
                return Redirect::to('/login');
            }
        }
    }
}