<?php namespace Shell\Offers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateShellOffersApplications extends Migration
{
    public function up()
    {
        Schema::create('shell_offers_applications', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('offer_id');
            $table->dateTime('date');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('shell_offers_applications');
    }
}
