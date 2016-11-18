<?php namespace Shell\Offers\Models;

use Model;

/**
 * Model
 */
class Application extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Validation
     */
    public $rules = [
    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'shell_offers_applications';


    /*
     * Relations
     */
    public $belongsTo = [
        'offer' => ['Shell\Offers\Models\Offer']
    ];
}