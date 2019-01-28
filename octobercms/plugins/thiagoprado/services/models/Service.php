<?php namespace ThiagoPrado\Services\Models;

use Model;

/**
 * Model
 */
class Service extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'thiagoprado_services_';

//    protected $jsonable = ['expectations'];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /* Relations */
    public $belongsToMany =[
        'clinic' =>[
            'Thiagoprado\Services\Models\Clinic',
            'table' =>'thiagoprado_services_clinic_pivot',
            'order' => 'clinic_title'

        ],
        'expectations' =>[
            'Thiagoprado\Services\Models\Expectation',
            'table' =>'thiagoprado_services_exp_pivot',
            'order' => 'name'

        ]
    ];

    public $attachOne = [
        'image' => 'System\Models\File'
    ];
}
