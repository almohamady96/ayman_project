<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->integer('receiver_id')->unsigned()->nullable();
            $table->foreign('receiver_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->string('type');
            $table->integer('linked_id');
            $table->text('content');
            $table->string('status')->default('unread');

            $table->integer('count')->default(1);

            $table->integer('parent_id')->nullable();
            $table->string('parent_type')->nullable();

            $table->integer('top_parent_id')->nullable();
            $table->string('top_parent_type')->nullable();

            $table->string('sendto')->default('admin');
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
        Schema::dropIfExists('notifications');
    }
}
