<?php namespace Shell\Offers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShellOffersJobTitles3 extends Migration
{
    public function up()
    {
        Schema::table('shell_offers_job_titles', function($table)
        {
            $table->boolean('is_site_manager');
        });
    }
    
    public function down()
    {
        Schema::table('shell_offers_job_titles', function($table)
        {
            $table->dropColumn('is_site_manager');
        });
    }
}
