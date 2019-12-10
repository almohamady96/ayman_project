<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('menu_id')->nullable()->unsigned();
            $table->foreign('menu_id')->references('id')->on('menus')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('type');
            $table->string('linked_id')->nullable();
            $table->text('external_link')->nullable();

            $table->integer('item_id')->nullable()->unsigned();
            $table->foreign('item_id')->references('id')->on('menu_items')
                ->onDelete('cascade');

            $table->integer('number')->nullable();
            $table->string('day')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}
