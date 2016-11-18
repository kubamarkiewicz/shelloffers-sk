<?php namespace Shell\Offers\Models;

use Model;
use Shell\Offers\Models\Station;
use Shell\Offers\Models\Province;

/**
 * Model
 */
class Offer extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    /*
     * Validation
     */
    public $rules = [
        'station' => 'required',
        'job_title' => 'required'
    ];

    public $customMessages = [
        // 'station.required' => 'Wybierz stanowisko',
        // 'job_title.required' => 'Wybierz stanowisko'
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
    public $table = 'shell_offers_offers';


    /*
     * Relations
     */
    public $belongsTo = [
        'created_by' => ['Backend\Models\User'],
        'station' => ['Shell\Offers\Models\Station'],
        'job_title' => ['Shell\Offers\Models\JobTitle'],
    ];


    public function getProvinceAttribute() {
         $station = Station::find($this->station_id);
         $province = Province::find($station->province_id);
         return $province->name;
    }




}