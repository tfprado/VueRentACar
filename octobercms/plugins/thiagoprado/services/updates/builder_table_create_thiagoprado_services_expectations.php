<?php namespace ThiagoPrado\Services\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThiagopradoServicesExpectations extends Migration
{
    public function up()
    {
        Schema::create('thiagoprado_services_expectations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name')->nullable();
            $table->text('descriptions')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thiagoprado_services_expectations');
    }
}
