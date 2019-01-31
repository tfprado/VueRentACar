<?php namespace Thiagoprado\Kensington\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThiagopradoKensingtonVehiclesDates extends Migration
{
    public function up()
    {
        Schema::create('thiagoprado_kensington_vehicles_dates', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('vehicle_id');
            $table->integer('date_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thiagoprado_kensington_vehicles_dates');
    }
}
