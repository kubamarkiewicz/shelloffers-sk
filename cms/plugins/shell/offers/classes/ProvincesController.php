<?php namespace Shell\Offers\Classes;

use Illuminate\Routing\Controller;
use Input;
use DB;

class ProvincesController extends Controller
{

    public function index()
    {
        if (Input::get('all')) {
            $sql = 'SELECT p.id, p.name FROM shell_offers_provinces AS p ';
        }
        else {
            $sql = 'SELECT DISTINCT p.id, p.name FROM shell_offers_offers AS o 
                        JOIN shell_offers_stations AS s ON o.station_id=s.id
                        JOIN shell_offers_provinces AS p ON s.province_id=p.id
                        JOIN shell_offers_job_titles AS j ON o.job_title_id=j.id
                        WHERE o.published=1
                        AND (o.activated_from <= "'.date("Y-m-d").'" OR o.activated_from IS NULL) 
                        AND (o.activated_to >= "'.date("Y-m-d").'" OR o.activated_to IS NULL) 
                    ';
            if ($jobTitleId = Input::get('jobTitleId')) {
                $sql .= 'AND j.id = "'.$jobTitleId.'" ';
            }
        }

        $sql .= 'ORDER BY p.name ASC';
        // echo $sql;

        $result = DB::select(DB::raw($sql));

        return response()->json($result, 200, array(), JSON_PRETTY_PRINT);
    }

}