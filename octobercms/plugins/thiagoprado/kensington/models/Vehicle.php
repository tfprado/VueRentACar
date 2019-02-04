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

    /**
     * Relations
     */
    public $belongsToMany = [
        'locations' => [
            'Thiagoprado\Kensington\Models\Location',
            'table' => 'thiagoprado_kensington_vehicles_locations',
            'order' => 'title'
        ],
        'dates' => [
            'Thiagoprado\Kensington\Models\Date',
            'table' => 'thiagoprado_kensington_vehicles_dates',
            'order' => 'pickup'
        ]
    ];

    public $attachOne = [
        'image' => 'System\Models\File'
    ];
}
