<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->increments('id');

            $table->text('q');
            $table->text('a1');
            $table->text('a2');
            $table->text('a3')->nullable();
            $table->text('a4')->nullable();
            $table->text('a5')->nullable();
            $table->text('position')->nullable();
            $table->string('status')->default('active');
            $table->string('publishDate');
            $table->string('expireDate');
            $table->string('publishTime');
            $table->string('expireTime');

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
        Schema::dropIfExists('questionnaires');
    }
}
