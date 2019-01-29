<?php namespace Thiagoprado\Kensington\Models;

use Model;

/**
 * Model
 */
class Vehicle extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'thiagoprado_kensington_vehicles';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
