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


    public function getStatusOptions()
    {
        return [
            'no_action' => trans('shell.offers::lang.application.application-status.no_action'),
            'invited_for_interview' => trans('shell.offers::lang.application.application-status.invited_for_interview'),
            'rejection_email_sent' => trans('shell.offers::lang.application.application-status.rejection_email_sent')
        ];
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


    public function getPublishedOptions()
    {
        return [
            0 => trans('backend::lang.list.column_switch_false'),
            1 => trans('backend::lang.list.column_switch_true')
        ];
    }


    public function getForExport($station_id = null)
    {
        $sql = "SELECT o.*, CONCAT(s.id, ' ', s.name) AS station, t.name AS job_title, p.name AS province, s.city
                FROM $this->table AS o
                LEFT JOIN shell_offers_stations AS s ON o.station_id = s.id
                LEFT JOIN shell_offers_job_titles AS t ON o.job_title_id = t.id
                LEFT JOIN shell_offers_provinces AS p ON s.province_id = p.id
                WHERE o.deleted_at IS NULL ";
        if ($station_id) {
            $sql .= "AND o.station_id='".(int)$station_id."' ";
        }

        $sql .= "ORDER BY id DESC";
        // echo $sql;
        $data = DB::select(DB::raw($sql));
        // dump($data); exit;
        return $data;
    }




}