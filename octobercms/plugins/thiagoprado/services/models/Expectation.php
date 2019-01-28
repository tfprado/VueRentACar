<?php namespace ThiagoPrado\Services\Models;

use Model;

/**
 * Model
 */
class Expectation extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'thiagoprado_services_expectations';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    /* Relations */
    public $belongsToMany =[
        'services' =>[
            'Thiagoprado\Services\Models\Service',
            'table' =>'thiagoprado_services_exp_pivot',
            'order' => 'name'

        ]
    ];

    public function getFullNameAttribute() {
        return $this->name;
        //If you have a table with name and last name columns
        //return $this->name . " " . $this->lastname;
    }
}
