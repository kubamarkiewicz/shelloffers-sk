<?php namespace Shell\Offers\Classes;

use Illuminate\Routing\Controller;
use Input;
use DB;

class JobTitlesController extends Controller
{

    public function index()
    {
        $sql = 'SELECT id, name FROM shell_offers_job_titles
                WHERE id IN (
                    SELECT DISTINCT job_title_id FROM shell_offers_offers
                    WHERE published=1
                    AND (activated_from <= "'.date("Y-m-d").'" OR activated_from IS NULL) 
                    AND (activated_to >= "'.date("Y-m-d").'" OR activated_to IS NULL) 
                    ORDER BY name ASC
                )';

        $result = DB::select(DB::raw($sql));

        return response()->json($result, 200, array(), JSON_PRETTY_PRINT);
    }

}