<?php namespace Shell\Offers;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{

    public function registerMailTemplates()
    {
        return [
            'shell.offers::mail.application' => 'Application mail is sent to site manager when a user applies for a job'
        ];
    }

}
