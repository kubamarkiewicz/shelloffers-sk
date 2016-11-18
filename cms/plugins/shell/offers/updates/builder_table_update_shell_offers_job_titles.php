<?php namespace Shell\Offers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShellOffersJobTitles extends Migration
{
    public function up()
    {
        Schema::rename('shell_offers_positions', 'shell_offers_job_titles');
        Schema::table('shell_offers_job_titles', function($table)
        {
            $table->increments('id')->unsigned(false)->change();
        });
    }
    
    public function down()
    {
        Schema::rename('shell_offers_job_titles', 'shell_offers_positions');
        Schema::table('shell_offers_positions', function($table)
        {
            $table->increments('id')->unsigned()->change();
        });
    }
}
