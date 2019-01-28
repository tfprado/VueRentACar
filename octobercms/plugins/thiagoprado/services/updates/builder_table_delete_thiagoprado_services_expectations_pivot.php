<?php namespace ThiagoPrado\Services\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteThiagopradoServicesExpectationsPivot extends Migration
{
    public function up()
    {
        Schema::dropIfExists('thiagoprado_services_expectations_pivot');
    }
    
    public function down()
    {
        Schema::create('thiagoprado_services_expectations_pivot', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('service_id')->unsigned();
            $table->integer('expectation_id')->unsigned();
        });
    }
}
