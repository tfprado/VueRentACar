<?php namespace ThiagoPrado\Services\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThiagopradoServicesExpectations extends Migration
{
    public function up()
    {
        Schema::table('thiagoprado_services_expectations', function($table)
        {
            $table->renameColumn('descriptions', 'description');
        });
    }
    
    public function down()
    {
        Schema::table('thiagoprado_services_expectations', function($table)
        {
            $table->renameColumn('description', 'descriptions');
        });
    }
}
