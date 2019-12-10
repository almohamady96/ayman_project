<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('uniqueName')->nullable();
            $table->string('email');

            $table->string('mobile')->nullable();
            $table->string('whatsApp')->nullable();
            $table->text('address')->nullable();
            $table->longText('categories')->nullable();

            $table->boolean('isAdmin')->nullable();
            $table->boolean('isActive')->default(1);
            $table->integer('role_id')->nullable();
            $table->string('account_type')->default('user');
            $table->string('day')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();

            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
