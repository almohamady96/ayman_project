<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();

            $table->string('type');
            $table->integer('category_id')->nullable();

            $table->string('position')->nullable();
            $table->string('status')->default('active');
            $table->string('publishDate');
            $table->string('expireDate');
            $table->string('publishTime');
            $table->string('expireTime');
            $table->longText('image')->nullable();
            $table->longText('cover')->nullable();
            $table->text('link')->nullable();
            $table->longText('code')->nullable();

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
        Schema::dropIfExists('ads');
    }
}
