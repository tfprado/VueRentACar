<?php namespace ThiagoPrado\Services\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThiagopradoServicesClinicPivot extends Migration
{
    public function up()
    {
        Schema::create('thiagoprado_services_clinic_pivot', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('service_id');
            $table->integer('clinic_id');
            $table->primary(['service_id','clinic_id']);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thiagoprado_services_clinic_pivot');
    }
}
