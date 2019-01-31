<?php namespace Thiagoprado\Kensington\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteThiagopradoKensingtonVeLo extends Migration
{
    public function up()
    {
        Schema::dropIfExists('thiagoprado_kensington_ve_lo');
    }
    
    public function down()
    {
        Schema::create('thiagoprado_kensington_ve_lo', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('vehicle_id');
            $table->integer('location_id');
            $table->primary(['vehicle_id','location_id']);
        });
    }
}
