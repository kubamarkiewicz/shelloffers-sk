<?php namespace Shell\Offers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateShellOffersProvinces extends Migration
{
    public function up()
    {
        Schema::create('shell_offers_provinces', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 70);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('shell_offers_provinces');
    }
}
