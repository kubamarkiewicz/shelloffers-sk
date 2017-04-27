<?php namespace Shell\Offers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShellOffersStations extends Migration
{
    public function up()
    {
        Schema::table('shell_offers_stations', function($table)
        {
            $table->softDeletes();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::table('shell_offers_stations', function($table)
        {
            $table->dropColumn('deleted_at');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
