<?php namespace Shell\Offers\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

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
        if (!$form->getField('created_by')->value) {
            $form->getField('created_by')->value = $this->user->id;
        }
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
    }

}