<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')
            ->onDelete('cascade');

            $table->string('author')->default('الإداره');
            $table->string('name');
            $table->text('summary')->nullable();
            $table->longText('description')->nullable();
            $table->string('publishDate')->nullable();

            $table->boolean('isFeature')->default(0);
            $table->string('isFeatureTime')->nullable();

            $table->string('file_type');
            $table->longText('file')->nullable();
            $table->longText('link')->nullable();

            $table->string('status')->default('published');

            $table->longText('image')->nullable();
            $table->longText('photos')->nullable();

            $table->text('slug')->nullable();

            $table->text('seo_title')->nullable();
            $table->longText('seo_keywords')->nullable();
            $table->longText('seo_description')->nullable();
            $table->longText('seo_image')->nullable();

            $table->integer('number')->nullable();
            $table->string('day')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();

            $table->string('visits')->default(0);

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
        Schema::dropIfExists('articles');
    }
}
