<?php namespace Shell\Offers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShellOffersOffers3 extends Migration
{
    public function up()
    {
        Schema::table('shell_offers_offers', function($table)
        {
            $table->dropColumn('title');
        });
    }
    
    public function down()
    {
        Schema::table('shell_offers_offers', function($table)
        {
            $table->string('title', 255);
        });
    }
}
