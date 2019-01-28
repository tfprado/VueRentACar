<?php namespace ThiagoPrado\Services\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableDeleteThiagopradoServicesServicesClinic extends Migration
{
    public function up()
    {
        Schema::dropIfExists('thiagoprado_services_services_clinic');
    }
    
    public function down()
    {
        Schema::create('thiagoprado_services_services_clinic', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('service_id');
            $table->integer('clinic_id');
        });
    }
}
