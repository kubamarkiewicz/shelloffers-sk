<?php namespace Shell\Offers\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use PHPExcel;
use PHPExcel_IOFactory;
use Shell\Offers\Models\Application as Application;
use DB;

class Applications extends Controller
{
    public $implement = ['Backend\Behaviors\ListController'];
    
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = [
        'see_statistics' 
    ];


    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Shell.Offers', 'main-menu-item', 'side-menu-item4');
    }


    public function listExtendQuery($query)
    {
        // join offers, stations, job titles
        $query->leftJoin('shell_offers_offers', 'shell_offers_applications.offer_id', '=', 'shell_offers_offers.id');
        $query->leftJoin('shell_offers_stations', 'shell_offers_offers.station_id', '=', 'shell_offers_stations.id');
        $query->leftJoin('shell_offers_job_titles', 'shell_offers_offers.job_title_id', '=', 'shell_offers_job_titles.id');

        // filter by stations assigned to current user
        if ($this->user->isManager()) {
            $query->where("shell_offers_offers.station_id", '=', $this->user->station_id);
        }
        else if ($this->user->isRetailer()) {
            $query->whereIn('shell_offers_offers.station_id', $this->user->getStationsIds());
        }
    }


    public function ajaxUpdateStatus()
    {
        // print_r($_POST);
        $application = Application::find($_POST['application_id']);
        $application->status = $_POST['status'];
        $application->save();

        $result = $application->status;
        return response()->json($result, 200, array(), JSON_PRETTY_PRINT);
    }

    
    function export() 
    {
        $model = new Application();
        $data = $model->getForExport();

        // Create new PHPExcel object
        $excel = new PHPExcel();
        $excel->setActiveSheetIndex(0);
        $sheet = $excel->getActiveSheet();

        // center align all columns
        $sheet->getDefaultStyle()->getAlignment()->setHorizontal('center');

        $sheet->setCellValueByColumnAndRow(0, 1, trans('shell.offers::lang.application.id'));
        $sheet->setCellValueByColumnAndRow(1, 1, trans('shell.offers::lang.application.date'));
        $sheet->setCellValueByColumnAndRow(2, 1, trans('shell.offers::lang.offer.id'));
        $sheet->setCellValueByColumnAndRow(3, 1, trans('shell.offers::lang.station.station'));
        $sheet->setCellValueByColumnAndRow(4, 1, trans('shell.offers::lang.job-title.job-title'));
        $sheet->setCellValueByColumnAndRow(5, 1, trans('shell.offers::lang.application.status'));

        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);
        $sheet->getStyle('A1:F1')->getBorders()->getBottom()->setBorderStyle('thick');

        if ($data) foreach ($data as $key => $item) {
            $sheet->setCellValueByColumnAndRow(0, $key+2, $item->id);
            $sheet->setCellValueByColumnAndRow(1, $key+2, $item->date);
            $sheet->setCellValueByColumnAndRow(2, $key+2, $item->offer_id);
            $sheet->setCellValueByColumnAndRow(3, $key+2, $item->station);
            $sheet->setCellValueByColumnAndRow(4, $key+2, $item->job_title);
            $sheet->setCellValueByColumnAndRow(5, $key+2, trans('shell.offers::lang.application.application-status.'.($item->status ? $item->status : 'no_action')));
        }
        
        // Rename worksheet
        $excel->getActiveSheet()->setTitle(trans('shell.offers::lang.application.applications'));

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.trans('shell.offers::lang.application.applications').' '.date("Y-m-d H-i").'.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        $excelWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $excelWriter->save('php://output');
        exit;
    }


}