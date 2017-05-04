<?php namespace Shell\Offers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShellOffersStations extends Migration
{
    public function up()
    {
        Schema::table('shell_offers_stations', function($table)
        {
            $table->renameColumn('province_', 'province_id');
            $table->dropColumn('province');
        });
    }
    
    public function down()
    {
        Schema::table('shell_offers_stations', function($table)
        {
            $table->renameColumn('province_id', 'province_');
            $table->string('province', 255);
        });
    }
}