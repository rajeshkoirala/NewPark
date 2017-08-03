<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('course_type_id');
            $table->integer('academy_course_id');
            $table->string('course_name');
            $table->string('course_short_desc');
            $table->text('course_detail_desc');
            $table->text('image_name');
            $table->text('video_link');
            $table->integer('status');
            $table->integer('created_by');
            $table->text('objective');
            $table->text('prerequisites');
            $table->text('who_should_attend');
            $table->text('certification');
            $table->text('course_content');
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
        Schema::dropIfExists('course');
    }
}
