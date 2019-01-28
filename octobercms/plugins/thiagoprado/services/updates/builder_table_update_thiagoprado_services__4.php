<?php namespace ThiagoPrado\Services\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThiagopradoServices4 extends Migration
{
    public function up()
    {
        Schema::table('thiagoprado_services_', function($table)
        {
            $table->text('expectations')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('thiagoprado_services_', function($table)
        {
            $table->dropColumn('expectations');
        });
    }
}
