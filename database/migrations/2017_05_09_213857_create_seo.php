<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('type_id');
            $table->string('meta_title');
            $table->string('meta_keyword');
            $table->text('meta_description');
            $table->string('meta_language');
            $table->text('meta_publisher');
            $table->text('meta_author');
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
