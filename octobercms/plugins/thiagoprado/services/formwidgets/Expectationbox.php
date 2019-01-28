<?php namespace Thiagoprado\Services\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Config;
use ThiagoPrado\Services\Models\Expectation;


class ExpectationBox extends FormWidgetBase
{
    public function widgetDetails()
    {
        return [
            'name' => 'Expectationbox',
            'description' => 'Field for adding expectations'
        ];
    }

    public function render(){
        $this->prepareVars();
    //    dump($this->vars['expectations']);
        return $this->makePartial('widget');
    }

    public function prepareVars(){
        $this->vars['id'] = $this->model->id;
        $this->vars['expectations'] = Expectation::all()->lists('name', 'id');
        $this->vars['name'] = $this->formField->getName().'[]';
        if(!empty($this->getLoadValue())){
            $this->vars['selectedValues'] = $this->getLoadValue();
        } else {
            $this->vars['selectedValues'] = [];
        }
    }

    public function getSaveValue($expectations){
        $newArray = [];

        foreach($expectations as $expectationID){
            if(!is_numeric($expectationID)){
                $newExpectation = new Expectation;
                
                $newExpectation->name = $expectationID;
                $newExpectation->save();
                $newArray[] = $newExpectation->id;
            } else {
                $newArray[] = $expectationID;
            }
        }

        return $newArray;
    }


    public function loadAssets()
    {
        $this->addCss('css/select2.css');
        $this->addJs('js/select2.js');
    }
}
