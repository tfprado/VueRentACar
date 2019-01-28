<?php namespace ThiagoPrado\Contact\Components;

use CMS\Classes\ComponentBase;
use Input;
use Mail;
use Validator;
use Redirect;

class ContactForm extends ComponentBase
{
    public function componentDetails(){

        return [
            'name' => 'Contact Form by Thiago',
            'description' => 'Simple demo contact form'
        ];
    }

    public function onSend(){

        $validator = Validator::make(
            [
                'name' => Input::get('name'),
                'email' => Input::get('email')
            ],
            [
                'name' => 'required',
                'email' => 'required|email'
            ]
        );

        if($validator->fails()){

            return Redirect::back()->withErrors($validator);
        }
        else{

            // These variables are available inside the message as Twig
            $vars = ['name' => Input::get('name'), 'email' => Input::get('email'), 'content' => Input::get('content')];

            // View being used to send message, add some-msg.htm file 
            // to view/mail and change mail.message to mail.some-message
            Mail::send('thiagoprado.contact::mail.message', $vars, function($message) {

                $message->to('tprado@kensingtonhealth.org', 'Thiago Prado');
                $message->subject('New message from test contact form');

            });
        }
    }
}