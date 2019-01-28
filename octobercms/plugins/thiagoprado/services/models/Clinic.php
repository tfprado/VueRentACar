<?php namespace ThiagoPrado\Services\Models;

use Model;

/**
 * Model
 */
class Clinic extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * Protected variables from task model, anything here is not mass fillable
     *
     * @var array
     */
    protected $guarded = [];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'thiagoprado_services_clinic';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /* Realtions */
    public $belongsToMany =[
        'services' =>[
            'Thiagoprado\Services\Models\Service',
            'table' =>'thiagoprado_services_clinic_pivot',
            'order' => 'name'

        ]
    ];
}
