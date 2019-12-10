<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('type');
            $table->integer('count')->nullable();

            $table->integer('category_id')->nullable()->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade');

            $table->integer('ad_id')->nullable()->unsigned();
            $table->foreign('ad_id')->references('id')->on('ads')
                ->onDelete('cascade');

            $table->integer('article_id')->nullable()->unsigned();
            $table->foreign('article_id')->references('id')->on('articles')
                ->onDelete('cascade');

            $table->integer('questionnaire_id')->nullable()->unsigned();
            $table->foreign('questionnaire_id')->references('id')->on('questionnaires')
                ->onDelete('cascade');

            $table->string('query_type')->nullable();

            $table->string('status')->default('active');

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
        Schema::dropIfExists('widgets');
    }
}
