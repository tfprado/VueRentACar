<?php namespace Thiagoprado\Kensington\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThiagopradoKensingtonVehicles2 extends Migration
{
    public function up()
    {
        Schema::table('thiagoprado_kensington_vehicles', function($table)
        {
            $table->boolean('availabel');
        });
    }
    
    public function down()
    {
        Schema::table('thiagoprado_kensington_vehicles', function($table)
        {
            $table->dropColumn('availabel');
        });
    }
}
