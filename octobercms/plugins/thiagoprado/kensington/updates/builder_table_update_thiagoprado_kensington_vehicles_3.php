<?php namespace Thiagoprado\Kensington\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThiagopradoKensingtonVehicles3 extends Migration
{
    public function up()
    {
        Schema::table('thiagoprado_kensington_vehicles', function($table)
        {
            $table->renameColumn('availabel', 'available');
        });
    }
    
    public function down()
    {
        Schema::table('thiagoprado_kensington_vehicles', function($table)
        {
            $table->renameColumn('available', 'availabel');
        });
    }
}
