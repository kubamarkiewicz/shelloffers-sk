<?php namespace Shell\Offers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateShellOffersOffers5 extends Migration
{
    public function up()
    {
        Schema::table('shell_offers_offers', function($table)
        {
            $table->text('description')->nullable()->change();
            $table->date('activated_from')->nullable()->change();
            $table->date('activated_to')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('shell_offers_offers', function($table)
        {
            $table->text('description')->nullable(false)->change();
            $table->date('activated_from')->nullable(false)->change();
            $table->date('activated_to')->nullable(false)->change();
        });
    }
}
