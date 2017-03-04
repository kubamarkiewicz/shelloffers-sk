<?php namespace Shell\Offers\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use PHPExcel;
use PHPExcel_IOFactory;
use Shell\Offers\Models\Offer as Offer;


class Offers extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'manage_offers' 
    ];


    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Shell.Offers', 'main-menu-item', 'side-menu-item');
    }

    public function formBeforeCreate($model)
    {
        $model->created_by_id = $this->user->id;
        if ($this->user->isManager()) {
            $model->station_id = $this->user->station->id;
        }
    }

    public function formExtendFields($form)    
    {
        if ($this->user->isManager()) {
            $form->getField('station')->value = $this->user->station_id;
            $form->getField('station')->disabled = 1;
        }
        if (($form->context == 'update') && !$this->user->hasAccess('delete_job_offers')) {
            $form->getField('activated_from')->disabled = 1;
            $form->getField('activated_to')->disabled = 1;
        }
    }

    public function listExtendQuery($query)
    {
        if ($this->user->isManager()) {
            $query->where('station_id', '=', $this->user->station_id);
        }
        else if ($this->user->isRetailer()) {
            $query->whereIn('station_id', $this->user->getStationsIds());
        }

        // join provinces
        // $query->leftJoin('shell_offers_stations AS s','s.id','=','shell_offers_offers.station_id');
        // $query->leftJoin('shell_offers_provinces AS p','p.id','=','s.province_id');
        // $query->select("p.name AS province");
        // $query->getQuery()->orders = null;
    }
   

    function export() 
    {
        $model = new Offer();
        $station_id = $this->user->hasAccess('manage_all_offers') ? null : $this->user->station_id;
        $data = $model->getForExport($station_id);

        // Create new PHPExcel object
        $excel = new PHPExcel();
        $excel->setActiveSheetIndex(0);
        $sheet = $excel->getActiveSheet();

        $sheet->setCellValueByColumnAndRow(0, 1, trans('shell.offers::lang.offer.id'));
        $sheet->setCellValueByColumnAndRow(1, 1, trans('shell.offers::lang.station.station'));
        $sheet->setCellValueByColumnAndRow(2, 1, trans('shell.offers::lang.job-title.job-title'));
        $sheet->setCellValueByColumnAndRow(3, 1, trans('shell.offers::lang.province.province'));
        $sheet->setCellValueByColumnAndRow(4, 1, trans('shell.offers::lang.station.city'));
        $sheet->setCellValueByColumnAndRow(5, 1, trans('shell.offers::lang.offer.valid-from'));
        $sheet->setCellValueByColumnAndRow(6, 1, trans('shell.offers::lang.offer.valid-to'));
        $sheet->setCellValueByColumnAndRow(7, 1, trans('shell.offers::lang.offer.published'));

        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(15);

        $sheet->getStyle('A')->getAlignment()->setHorizontal('left');
        $sheet->getStyle('H')->getAlignment()->setHorizontal('left');

        if ($data) foreach ($data as $key => $item) {
            $sheet->setCellValueByColumnAndRow(0, $key+2, $item->id);
            $sheet->setCellValueByColumnAndRow(1, $key+2, $item->station);
            $sheet->setCellValueByColumnAndRow(2, $key+2, $item->job_title);
            $sheet->setCellValueByColumnAndRow(3, $key+2, $item->province);
            $sheet->setCellValueByColumnAndRow(4, $key+2, $item->city);
            $sheet->setCellValueByColumnAndRow(5, $key+2, $item->activated_from);
            $sheet->setCellValueByColumnAndRow(6, $key+2, $item->activated_to);
            $sheet->setCellValueByColumnAndRow(7, $key+2, $item->published ? trans('backend::lang.list.column_switch_true') : trans('backend::lang.list.column_switch_false'));
        }
        
        // Rename worksheet
        $excel->getActiveSheet()->setTitle(trans('shell.offers::lang.offer.job-offers'));

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.trans('shell.offers::lang.offer.job-offers').' '.date("Y-m-d H-i").'.xlsx"');
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