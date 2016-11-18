<?php namespace Shell\Offers\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Provinces extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'manage_stations' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Shell.Offers', 'main-menu-item', 'side-menu-item5');
    }
}