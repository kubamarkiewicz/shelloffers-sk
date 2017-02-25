<?php namespace Shell\Offers;

require_once __DIR__.'/vendor/autoload.php';

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function registerMailTemplates()
    {
        return [
            'shell.offers::mail.application' => 'Application mail is sent to site manager when a user applies for a job'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Settings',
                'description' => 'Manage custom settings.',
                'category'    => 'Shell Job Offers Settings',
                'icon'        => 'icon-cog',
                'class'       => 'Shell\Offers\Models\Settings',
                'order'       => 0,
                'keywords'    => 'security location',
                'permissions' => ['edit_shell_settings']
            ]
        ];
    }

}
