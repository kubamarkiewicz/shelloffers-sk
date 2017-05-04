<?php namespace Shell\Offers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShellOffersApplications extends Migration
{
    public function up()
    {
        Schema::table('shell_offers_applications', function($table)
        {
            $table->text('status');
        });
    }
    
    public function down()
    {
        Schema::table('shell_offers_applications', function($table)
        {
            $table->dropColumn('status');
        });
    }
}
