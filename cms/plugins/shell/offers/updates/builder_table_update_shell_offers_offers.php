<?php namespace Shell\Offers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShellOffersOffers extends Migration
{
    public function up()
    {
        Schema::table('shell_offers_offers', function($table)
        {
            $table->renameColumn('created_by_admin', 'created_by_id');
        });
    }
    
    public function down()
    {
        Schema::table('shell_offers_offers', function($table)
        {
            $table->renameColumn('created_by_id', 'created_by_admin');
        });
    }
}
