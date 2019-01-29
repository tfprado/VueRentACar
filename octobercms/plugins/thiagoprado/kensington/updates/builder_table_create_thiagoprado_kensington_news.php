<?php namespace Thiagoprado\Kensington\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateThiagopradoKensingtonNews extends Migration
{
    public function up()
    {
        Schema::create('thiagoprado_kensington_news', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('thiagoprado_kensington_news');
    }
}
