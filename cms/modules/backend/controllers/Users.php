<?php namespace Backend\Controllers;

use Backend;
use BackendMenu;
use BackendAuth;
use Backend\Models\UserGroup;
use Backend\Classes\Controller;
use System\Classes\SettingsManager;
use Backend\Models\User;

/**
 * Backend user controller
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 *
 */
class Users extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['backend.manage_users'];

    public $bodyClass = 'compact-container';

    public function __construct()
    {
        parent::__construct();

        if ($this->action == 'myaccount') {
            $this->requiredPermissions = null;
        }

        BackendMenu::setContext('October.System', 'system', 'users');
        SettingsManager::setContext('October.System', 'administrators');
    }

    /**
     * Update controller
     */
    public function update($recordId, $context = null)
    {
        // Users cannot edit themselves, only use My Settings
        if ($context != 'myaccount' && $recordId == $this->user->id) {
            return Backend::redirect('backend/users/myaccount');
        }

        return $this->asExtension('FormController')->update($recordId, $context);
    }

    /**
     * My Settings controller
     */
    public function myaccount()
    {
        SettingsManager::setContext('October.Backend', 'myaccount');

        $this->pageTitle = 'backend::lang.myaccount.menu_label';
        return $this->update($this->user->id, 'myaccount');
    }

    /**
     * Proxy update onSave event
     */
    public function myaccount_onSave()
    {
        $result = $this->asExtension('FormController')->update_onSave($this->user->id, 'myaccount');

        /*
         * If the password or login name has been updated, reauthenticate the user
         */
        $loginChanged = $this->user->login != post('User[login]');
        $passwordChanged = strlen(post('User[password]'));
        if ($loginChanged || $passwordChanged) {
            BackendAuth::login($this->user->reload(), true);
        }

        return $result;
    }

    /**
     * Add available permission fields to the User form.
     * Mark default groups as checked for new Users.
     */
    public function formExtendFields($form)
    {
        if ($form->getContext() == 'myaccount') {
            return;
        }

        if (!$this->user->isSuperUser()) {
            $form->removeField('is_superuser');
        }

        /*
         * Add permissions tab
         */
        if ($this->user->isSuperUser()) {
            $form->addTabFields($this->generatePermissionsField());
        }

        /*
         * Mark default groups
         */
        if (!$form->model->exists) {
            $defaultGroupIds = UserGroup::where('is_new_user_default', true)->lists('id');

            $groupField = $form->getField('groups');
            $groupField->value = $defaultGroupIds;
        }
    }

    /**
     * Adds the permissions editor widget to the form.
     * @return array
     */
    protected function generatePermissionsField()
    {
        return [
            'permissions' => [
                'tab' => 'backend::lang.user.permissions',
                'type' => 'Backend\FormWidgets\PermissionEditor',
                'trigger' => [
                    'action' => 'disable',
                    'field' => 'is_superuser',
                    'condition' => 'checked'
                ]
            ]
        ];
    }
/*
    public function create_onSave($context = null) 
    {
        dump($_POST); exit;
    }
*/
/*
    public function import() 
    {
        // load data from file
        // $file = base_path().'/storage/temp/import/test.csv';
        // $file = base_path().'/storage/temp/import/territory_managers.csv';
        // $file = base_path().'/storage/temp/import/cluster_managers.csv';
        $file = base_path().'/storage/temp/import/site_managers_3.csv';

        // group ID
        $groupId = 2; // Site Managers
        // $groupId = 3; // Territory / Cluster Managers



        /////////////////////////////////////////////////////////////////

        $data = file($file);
        foreach ($data as $key => $line) {
            $data[$key] = explode(';', trim($line));
        }

        // assign fields
        $usersData = [];
        foreach ($data as $fields) {
            if (@!$fields[1]) {
                continue;
            }
            $userData = [];
            $userData['station_id'] = $fields[0] ? : null;
            $userData['login'] = $fields[1];
            $userData['email'] = $fields[1];
            $userData['password'] = $this->randomPassword();
            @$userData['first_name'] = $fields[3] ? : $fields[1];
            $usersData[] = $userData;
        }
        // dump($usersData); exit();

        echo '<pre>';
        foreach ($usersData as $userData) {
            
            echo $userData['email'];

            // create user
            $user = new User;
            $user->station_id = $userData['station_id'];
            $user->login = $userData['login'];
            $user->email = $userData['email'];
            $user->password = $userData['password'];
            $user->password_confirmation = $userData['password'];
            $user->first_name = $userData['first_name'];
            $user->save();

            // add to the group
            $group = UserGroup::find($groupId); 
            $user->addGroup($group);

            // send email
            $user->sendInvitation();
            echo "\n";

        }
        
        exit('end');
    }
*/

    private function randomPassword()
    {
        /* Programmed by Christian Haensel
        ** christian@chftp.com
        ** http://www.chftp.com
        **
        ** Exclusively published on weberdev.com.
        ** If you like my scripts, please let me know or link to me.
        ** You may copy, redistribute, change and alter my scripts as
        ** long as this information remains intact.
        **
        ** Modified by Josh Hartman on 12/30/2010.
        */
        $length=6;
        $conso=array('b','c','d','f','g','h','j','k','l','m','n','p','r','s','t','v','w','x','y','z');
        $vocal=array('a','e','i','o','u');
        $password='';
        srand ((double)microtime()*1000000);
        $max = $length/2;
        for($i=1; $i<=$max; $i++){
            $password.=$conso[rand(0,19)];
            $password.=$vocal[rand(0,4)];
        }
        $password .= rand(10,99);


        $non_alphanum = '_-+*!#$?';
        $symbol = $non_alphanum[rand(0, strlen($non_alphanum)-1)];
    
        return $symbol.$symbol.$password.$symbol.$symbol;  
    }

/*
    public function importNames() 
    {
        // load data from file
        $file = base_path().'/storage/temp/import/imiona_DODO.csv';


        /////////////////////////////////////////////////////////////////
        echo '<pre>';

        $data = file($file);
        foreach ($data as $key => $line) {
            $data[$key] = explode(';', trim($line));
        }
        // dump($data); exit();

        // updates models
        foreach ($data as $fields) {
            @$email = $fields[0];
            @$name = $fields[1];
            if (!$email || !$name) {
                continue;
            }
            echo "\n".$email.' : ';
            $user = User::where('email', $email)->first();
            $first_name = $last_name = '';
            @list($first_name, $last_name) = explode(' ', $name);
            echo $first_name.' '.$last_name;
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            // dump($user); exit();
            $user->save();
            // exit;
        }
        
        exit('end');
    }
*/

}
