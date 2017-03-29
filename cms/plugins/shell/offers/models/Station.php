<?php namespace Shell\Offers\Models;

use Model;
use Db;
use BackendAuth;

/**
 * Model
 */
class Station extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;



    /**
     * Validation rules
     */
    public $rules = [
        'id' => 'required|unique:shell_offers_stations',
        'email' => 'required|email'
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

    /**
     * Scope a query to only include stations assigned to current user
     */
    public function scopeAssigned($query)
    {
        // todo: scopes not working
        $user = BackendAuth::getUser();

        if ($this->user->isManager()) {
            $query->where('id', '=', $this->user->station_id);
        }
        else if ($this->user->isRetailer()) {
            $query->whereIn('id', $this->user->getStationsIds());
        }
        return $query;
    }



    public function getCities()
    {
        $query = Db::table($this->table);

        // filter by stations assigend to current user
        $user = BackendAuth::getUser();
        if ($user->isManager()) {
            $query->where('id', '=', $user->station_id);
        }
        else if ($user->isRetailer()) {
            $query->whereIn('id', $user->getStationsIds());
        }

        return $query->lists('city');
    }

    
}