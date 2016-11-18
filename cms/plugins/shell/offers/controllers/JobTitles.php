<?php namespace Shell\Offers\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Shell\Offers\Models\JobTitle as JobTitle;
use Response;

class JobTitles extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'manage_job_positions',
        'manage_offers' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Shell.Offers', 'main-menu-item', 'side-menu-item3');
    }

    /**
     * get jobTitle data to fill in description in jobOffer form 
     * called via ajax
     */
    public function apiGetTemplate($job_title_id)
    {
        $result = JobTitle::find($job_title_id);

        return Response::json($result->offer_template); 
    }
}