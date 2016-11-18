<?php namespace Shell\Offers\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

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
}