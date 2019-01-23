<?php namespace Kensington\Ldap;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public $elevated = true;

    public function boot()
    {
    }
    public function registerComponents()
    {
        return [
            'Kensington\Ldap\Components\KensingtonLogin' => 'kensingtonlogin',
        ];
    }

    public function registerSettings()
    {
    }
}
