<?php namespace Shell\Offers\Classes;

use Illuminate\Routing\Controller;
use Input;
use DB;
use Shell\Offers\Models\Offer;

class OffersController extends Controller
{
    private $pageSize = 50; 

    public function index()
    {
        $result = new \StdClass;
        $result->pageSize = $this->pageSize;

        $sql = 'SELECT o.*, j.name AS job_title, s.city, s.street FROM shell_offers_offers AS o
                INNER JOIN shell_offers_job_titles AS j ON o.job_title_id=j.id
                INNER JOIN shell_offers_stations AS s ON o.station_id=s.id
                WHERE o.published=1
                AND o.deleted_at IS NULL
                AND (o.activated_from <= "'.date("Y-m-d").'" OR o.activated_from IS NULL) 
                AND (o.activated_to >= "'.date("Y-m-d").'" OR o.activated_to IS NULL) ';
        if ($keyword = Input::get('keyword')) {
            $sql .= 'AND (
                        (o.description LIKE "%'.$keyword.'%") OR
                        (j.name LIKE "%'.$keyword.'%") OR
                        (s.city LIKE "%'.$keyword.'%") OR
                        (s.street LIKE "%'.$keyword.'%")
                    )';
        }
        if ($jobTitleId = Input::get('jobTitleId')) {
            $sql .= 'AND o.job_title_id = '.$jobTitleId.' ';
        }
        if ($provinceId = Input::get('provinceId')) {
            $sql .= 'AND s.province_id = "'.$provinceId.'" ';
        }
        if ($city = Input::get('city')) {
            $sql .= 'AND s.city = "'.$city.'" ';
        }

        // count offers
        $result->totalCount = count(DB::select(DB::raw($sql)));

        
        $sql .= '
                ORDER BY o.activated_from DESC
        ';
        if ($page = Input::get('page')) {
            // $offset = ($page - 1) * $this->pageSize;
            // $sql .= 'LIMIT '.$this->pageSize.' OFFSET '.$offset;
            
            switch ($page) {
                case 1 : // load first page
                    $sql .= 'LIMIT '.$this->pageSize.' OFFSET 0 ';
                    break;
                case 2 : // load all the rest
                    $sql .= 'LIMIT 18446744073709551615 OFFSET '.$this->pageSize.' ';
                    break;
            }

        }
        // echo $sql;

        $result->offers = DB::select(DB::raw($sql));

        return response()->json($result, 200, array(), JSON_PRETTY_PRINT);
    }

    public function get($id)
    {
        $offer = Offer::with('station', 'job_title')->find($id);

        return response()->json($offer, 200, array(), JSON_PRETTY_PRINT);
    }

}