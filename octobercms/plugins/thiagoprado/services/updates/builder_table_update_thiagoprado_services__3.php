<?php namespace ThiagoPrado\Services\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThiagopradoServices3 extends Migration
{
    public function up()
    {
        Schema::table('thiagoprado_services_', function($table)
        {
            $table->dropColumn('clinic');
        });
    }
    
    public function down()
    {
        Schema::table('thiagoprado_services_', function($table)
        {
            $table->string('clinic', 191);
        });
    }
}
