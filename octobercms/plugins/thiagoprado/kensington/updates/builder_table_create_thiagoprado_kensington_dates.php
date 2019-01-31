<?php namespace Thiagoprado\Kensington\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThiagopradoKensingtonDates extends Migration
{
    public function up()
    {
        Schema::create('thiagoprado_kensington_dates', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->dateTime('pickup');
            $table->dateTime('drop_off');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thiagoprado_kensington_dates');
    }
}
