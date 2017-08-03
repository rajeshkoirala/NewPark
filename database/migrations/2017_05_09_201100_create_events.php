<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id');
            $table->string('event_name');
            $table->text('event_desc');
            $table->string('event_time_start');
            $table->string('event_time_end');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->string('repeat_event');
            $table->integer('no_of_seat');
            $table->integer('created_by');
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
        Schema::dropIfExists('events');
    }
}
