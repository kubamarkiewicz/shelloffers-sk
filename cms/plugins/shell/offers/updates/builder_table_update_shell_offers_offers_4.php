<?php namespace Shell\Offers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShellOffersOffers4 extends Migration
{
    public function up()
    {
        Schema::table('shell_offers_offers', function($table)
        {
            $table->date('activated_from');
            $table->date('activated_to');
        });
    }
    
    public function down()
    {
        Schema::table('shell_offers_offers', function($table)
        {
            $table->dropColumn('activated_from');
            $table->dropColumn('activated_to');
        });
    }
}
