<?php namespace Shell\Offers\Classes;

use Illuminate\Routing\Controller;
use Input;
use DB;

class CitiesController extends Controller
{

    public function index()
    {
        $sql = 'SELECT DISTINCT s.city FROM shell_offers_offers AS o
                    INNER JOIN shell_offers_stations AS s ON o.station_id=s.id
                    INNER JOIN shell_offers_job_titles AS j ON o.job_title_id=j.id
                    WHERE o.published=1
                    AND (o.activated_from <= "'.date("Y-m-d").'" OR o.activated_from IS NULL) 
                    AND (o.activated_to >= "'.date("Y-m-d").'" OR o.activated_to IS NULL) 
                ';
        if ($jobTitleId = Input::get('jobTitleId')) {
            $sql .= 'AND j.id = "'.$jobTitleId.'" ';
        }
        if ($provinceId = Input::get('provinceId')) {
            $sql .= 'AND s.province_id = "'.$provinceId.'" ';
        }
        $sql .= '
                ORDER BY s.city ASC
        ';

        $result = DB::select(DB::raw($sql));

        return response()->json($result, 200, array(), JSON_PRETTY_PRINT);
    }

}