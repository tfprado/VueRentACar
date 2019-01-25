<?php namespace Radiantweb\Proevents\Models;

use Model;
use Validator;

class Settings extends Model
{
    use \October\Rain\Database\Traits\Validation;
    //{}
    /*
     * Validation
     */
    public $rules = [
        'pe_dropoff' => "date_format:H:i:s"
    ];

    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'proevents_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

}