<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelatedCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id');
            $table->integer('rel_course_id');
            $table->string('rel_course_name');
            $table->string('created_by');
            $table->integer('discount');
            $table->string('created_by');
            $table->integer('status');
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
        Schema::dropIfExists('related_courses');
    }
}
