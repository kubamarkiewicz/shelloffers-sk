<?php namespace Shell\Offers\Models;

use Model;
use Shell\Offers\Models\Station;
use Shell\Offers\Models\Province;
use DB;
use BackendAuth;

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


    public function getProvinceAttribute() 
    {
        if ($station = Station::find($this->station_id)) {
            if ($province = Province::find($station->province_id)) {
                return $province->name;
            }
        }
    } 

    public function getStationOptions()
    {
        $query = Station::select('id', 'name');
        $user = BackendAuth::getUser();

        if ($user->isManager()) {
            $query->where('id', '=', $user->station_id);
        }
        else if ($user->isRetailer()) {
            $query->whereIn('id', $user->getStationsIds());
        }

        $options = $query->lists('name', 'id');
        if ($options) foreach ($options as $key => $value) {
            $options[$key] = $key.' '.$value;
        }
        return $options;
    }




}