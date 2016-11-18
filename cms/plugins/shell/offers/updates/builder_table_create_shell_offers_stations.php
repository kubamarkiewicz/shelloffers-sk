<?php namespace Shell\Offers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateShellOffersStations extends Migration
{
    public function up()
    {
        Schema::create('shell_offers_stations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id');
            $table->string('email', 255);
            $table->string('name', 255);
            $table->string('post_code', 20);
            $table->string('city', 255);
            $table->string('street', 255);
            $table->string('province', 255);
            $table->primary(['id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('shell_offers_stations');
    }
}