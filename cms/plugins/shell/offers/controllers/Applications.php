<?php namespace Shell\Offers\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use PHPExcel;
use PHPExcel_IOFactory;
use Shell\Offers\Models\Application as Application;


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

    
    function export() 
    {
        $model = new Application();
        $data = $model->getForExport();

        // Create new PHPExcel object
        $excel = new PHPExcel();
        $excel->setActiveSheetIndex(0);
        $sheet = $excel->getActiveSheet();

        $sheet->setCellValueByColumnAndRow(0, 1, trans('shell.offers::lang.application.id'));
        $sheet->setCellValueByColumnAndRow(1, 1, trans('shell.offers::lang.application.date'));
        $sheet->setCellValueByColumnAndRow(2, 1, trans('shell.offers::lang.station.station'));
        $sheet->setCellValueByColumnAndRow(3, 1, trans('shell.offers::lang.job-title.job-title'));
        $sheet->setCellValueByColumnAndRow(4, 1, trans('shell.offers::lang.offer.id'));

        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(15);

        $sheet->getStyle('A')->getAlignment()->setHorizontal('left');
        $sheet->getStyle('E')->getAlignment()->setHorizontal('left');

        if ($data) foreach ($data as $key => $item) {
            $sheet->setCellValueByColumnAndRow(0, $key+2, $item->id);
            $sheet->setCellValueByColumnAndRow(1, $key+2, $item->date);
            $sheet->setCellValueByColumnAndRow(2, $key+2, $item->station);
            $sheet->setCellValueByColumnAndRow(3, $key+2, $item->job_title);
            $sheet->setCellValueByColumnAndRow(4, $key+2, $item->offer_id);
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