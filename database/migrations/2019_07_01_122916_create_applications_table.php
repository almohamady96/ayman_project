<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('CompanyName');
            $table->string('PersonName');
            $table->string('Title');
            $table->string('Activity')->nullable();
            $table->string('Country')->nullable();
            $table->string('Address')->nullable();
            $table->string('Email');
            $table->string('Phone');
            $table->string('Mobile')->nullable();
            $table->string('Security')->nullable();
            $table->string('WebSite')->nullable();
            $table->string('SQM')->nullable();
            $table->text('msg')->nullable();
            $table->string('Status');
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
        Schema::dropIfExists('applications');
    }
}
