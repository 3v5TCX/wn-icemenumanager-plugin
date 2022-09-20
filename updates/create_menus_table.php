<?php namespace IceCollection\MenuManager\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateMenusTable extends Migration
{

    public function up()
    {
        Schema::create('icecollection_menumanager_menus', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->index()->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('url')->nullable();
            $table->integer('nest_left');
            $table->integer('nest_right');
            $table->integer('nest_depth')->nullable();
			$table->integer('enabled')->default(1);
            $table->string('parameters')->nullable();
            $table->string('query_string')->nullable();
			$table->boolean('is_external')->default(false);
			$table->string('link_target')->default('_self');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('avers_menumanager_menus');
    }

}
