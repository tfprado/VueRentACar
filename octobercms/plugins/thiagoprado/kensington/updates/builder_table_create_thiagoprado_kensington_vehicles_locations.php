<?php namespace Thiagoprado\Kensington\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThiagopradoKensingtonVeLo extends Migration
{
    public function up()
    {
        Schema::create('thiagoprado_kensington_vehicles_locations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('vehicle_id');
            $table->integer('location_id');
            $table->primary(['vehicle_id','location_id'], 'tp_locations_vehicles');
        });
    }

    public function down()
    {
        Schema::dropIfExists('thiagoprado_kensington_vehicles_locations');
    }
}
