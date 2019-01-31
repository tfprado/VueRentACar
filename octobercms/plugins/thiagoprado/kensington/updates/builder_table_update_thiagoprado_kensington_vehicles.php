<?php namespace Thiagoprado\Kensington\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThiagopradoKensingtonVehicles extends Migration
{
    public function up()
    {
        Schema::table('thiagoprado_kensington_vehicles', function($table)
        {
            $table->integer('price')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('thiagoprado_kensington_vehicles', function($table)
        {
            $table->dropColumn('price');
        });
    }
}
