<?php namespace Shell\Offers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShellOffersOffers2 extends Migration
{
    public function up()
    {
        Schema::table('shell_offers_offers', function($table)
        {
            $table->integer('job_title_id');
            $table->integer('station_id');
        });
    }
    
    public function down()
    {
        Schema::table('shell_offers_offers', function($table)
        {
            $table->dropColumn('job_title_id');
            $table->dropColumn('station_id');
        });
    }
}
