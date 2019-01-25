<?php namespace Radiantweb\Proevents\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use DB;

class UpdateGeneratedDateFieldname extends Migration
{

    public function up()
    {
        Schema::table('radiantweb_generated_dates', function ($table) {
            $table->renameColumn('date', 'event_date');
        });
    }

    public function down()
    {

    }

}
