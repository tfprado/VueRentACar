<?php namespace ThiagoPrado\Services;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'ThiagoPrado\Services\Components\Expectations' => 'expectations',
            'ThiagoPrado\Services\Components\ExpectationForm' => 'expectationsform'
        ];
    }

    public function registerSettings()
    {
    }

    public function registerFormWidgets()
    {
        return [
            'ThiagoPrado\Services\FormWidgets\Expectationbox' => [
                'label' => 'Expectationbox field',
                'code'  => 'expectationbox'
            ]    
        ];
    }
}
