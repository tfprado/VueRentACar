<?php namespace ThiagoPrado\Services\Components;

use CMS\Classes\ComponentBase;
use Input;
use Validator;
use Redirect;
use ThiagoPrado\Services\Models\Expectation;
use Flash;

class ExpectationForm extends ComponentBase
{
    public function componentDetails(){

        return [
            'name' => 'Expectation Form by Thiago',
            'description' => 'Demo Front End Form'
        ];
    }

    public function onSave(){

        //Laravel way
        $expectation = new Expectation();

        $expectation->name = Input::get('name');
        $expectation->description = Input::get('description');

        $expectation->save();

        Flash::success("Expectation Added!");

        return Redirect::back();

    }
}