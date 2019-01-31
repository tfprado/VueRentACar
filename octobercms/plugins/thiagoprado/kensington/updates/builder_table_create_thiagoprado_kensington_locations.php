<?php namespace Thiagoprado\Kensington\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThiagopradoKensingtonLocations extends Migration
{
    public function up()
    {
        Schema::create('thiagoprado_kensington_locations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thiagoprado_kensington_locations');
    }
}
