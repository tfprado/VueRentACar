<?php namespace ThiagoPrado\Services\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThiagopradoServicesClinic extends Migration
{
    public function up()
    {
        Schema::create('thiagoprado_services_clinic', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('clinic_title');
            $table->string('slug');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thiagoprado_services_clinic');
    }
}
