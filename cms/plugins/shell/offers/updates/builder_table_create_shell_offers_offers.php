<?php namespace Shell\Offers\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateShellOffersOffers extends Migration
{
    public function up()
    {
        Schema::create('shell_offers_offers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 255);
            $table->timestamp('created_at');
            $table->integer('created_by_admin');
            $table->boolean('published')->default(0);
            $table->text('description');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('shell_offers_offers');
    }
}
