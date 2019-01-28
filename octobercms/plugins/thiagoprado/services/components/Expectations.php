<?php namespace ThiagoPrado\Services\Components;

use Cms\Classes\ComponentBase;
use ThiagoPrado\Services\Models\Expectation;

class Expectations extends ComponentBase{

    public $expectations;

    public function componentDetails(){
        return [
            'name' => 'Expectation List',
            'description' => 'List of Expectations'
        ];
    }

    public function defineProperties(){
        return [
            'results' => [
                'title' => 'Number of Actors',
                'description' => 'How many expectations do you want to display?',
                'default' => 0,
                'validationPattern' => '^[0-9]+$', //validation pattern for numbers
                'validationMessage' => 'Only numbers are allowed'
            ],

            'sortOrder' => [
                'title' => 'Sort Expectations',
                'description' => 'Sort Expectations',
                'type' => 'dropdown',
                'default' => 'name asc'
            ]
        ];
    }

    public function getSortOrderOptions(){
        return [
            'name asc' => 'Name (ascending)',
            'name desc' => 'Name (descending)'
        ];
    }

    public function onRun(){
        $this->expectations = $this->loadExpectations();
    }

    protected function loadExpectations(){
        $query = Expectation::all();

        if ($this->property('sortOrder') == 'name asc'){
            $query = $query->sortBy('name'); //laravel function
        }

        if ($this->property('sortOrder') == 'name desc'){
            $query = $query->sortByDesc('name');//another laravel function
        }

        if ($this->property('results') > 0){
            $query = $query->take($this->property('results'));
        }
        return $query;
    }

    
}