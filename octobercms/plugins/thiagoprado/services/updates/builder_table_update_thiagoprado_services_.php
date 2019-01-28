<?php namespace ThiagoPrado\Services\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateThiagopradoServices extends Migration
{
    public function up()
    {
        Schema::table('thiagoprado_services_', function($table)
        {
            $table->string('clinic');
            $table->increments('id')->unsigned(false)->change();
            $table->string('name')->change();
        });
    }
    
    public function down()
    {
        Schema::table('thiagoprado_services_', function($table)
        {
            $table->dropColumn('clinic');
            $table->increments('id')->unsigned()->change();
            $table->string('name', 191)->change();
        });
    }
}
