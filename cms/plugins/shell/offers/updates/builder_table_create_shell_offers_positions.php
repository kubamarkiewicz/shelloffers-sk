<?php namespace Shell\Offers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateShellOffersPositions extends Migration
{
    public function up()
    {
        Schema::create('shell_offers_positions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255);
            $table->text('offer_template');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('shell_offers_positions');
    }
}
