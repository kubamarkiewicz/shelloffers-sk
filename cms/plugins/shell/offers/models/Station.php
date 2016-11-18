<?php namespace Shell\Offers\Models;

use Model;

/**
 * Model
 */
class Station extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    /*
     * Validation
     */
    public $rules = [
    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    //public $timestamps = false;

    protected $dates = ['deleted_at'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'shell_offers_stations';



    /*
     * Relations
     */
    public $belongsTo = [
        'province' => ['Shell\Offers\Models\Province', 'order' => 'name'],
    ];


    public function getFullNameAttribute()
    {
        return $this->id . " " . $this->name;
    }
    
}