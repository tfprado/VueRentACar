<?php namespace ThiagoPrado\Services\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThiagopradoServicesExpPivot extends Migration
{
    public function up()
    {
        Schema::create('thiagoprado_services_exp_pivot', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('service_id')->unsigned();
            $table->integer('expectation_id')->unsigned();
            $table->primary(['service_id','expectation_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thiagoprado_services_exp_pivot');
    }
}
