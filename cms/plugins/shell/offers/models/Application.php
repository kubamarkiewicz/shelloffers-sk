<?php namespace Shell\Offers\Models;

use Model;
use DB;

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
    
    public function getForExport()
    {
        $sql = "SELECT a.*, CONCAT(s.id, ' ', s.name) AS station, t.name AS job_title
                FROM $this->table AS a
                LEFT JOIN shell_offers_offers AS o ON a.offer_id = o.id
                LEFT JOIN shell_offers_stations AS s ON o.station_id = s.id
                LEFT JOIN shell_offers_job_titles AS t ON o.job_title_id = t.id
                ORDER BY a.date DESC";
        // echo $sql;
        $data = DB::select(DB::raw($sql));
        // dump($data); exit;
        return $data;
    }

}