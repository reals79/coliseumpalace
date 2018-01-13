<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('content_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('content_id')->unsigned()->nullable();
            $table->integer('content_main_id')->unsigned()->nullable();
            $table->integer('content_about_id')->unsigned()->nullable();
            $table->integer('content_simple_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->longText('descr')->nullable();
            $table->char('locale', 3)->index();

            $table->unique(['content_id', 'locale']);
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
            $table->foreign('content_main_id')->references('id')->on('contents')->onDelete('cascade');
            $table->foreign('content_about_id')->references('id')->on('contents')->onDelete('cascade');
            $table->foreign('content_simple_id')->references('id')->on('contents')->onDelete('cascade');
        });

        Schema::create('gallery_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('gallery_id')->unsigned();
            $table->string('name');
            $table->char('locale', 3)->index();

            $table->unique(['gallery_id', 'locale']);
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
        });

        Schema::create('video_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('video_id')->unsigned();
            $table->string('name');
            $table->char('locale', 3)->index();

            $table->unique(['video_id', 'locale']);
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
        });

        Schema::create('building_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('building_id')->unsigned();
            $table->string('name');
            $table->char('locale', 3)->index();

            $table->unique(['building_id', 'locale']);
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
        });

        Schema::create('apartment_type_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('apartment_type_id')->unsigned();
            $table->string('name');
            $table->char('locale', 3)->index();

            $table->unique(['apartment_type_id', 'locale']);
            $table->foreign('apartment_type_id')->references('id')->on('apartment_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('content_translations');
        Schema::dropIfExists('gallery_translations');
        Schema::dropIfExists('video_translations');
        Schema::dropIfExists('building_translations');
        Schema::dropIfExists('apartment_type_translations');
    }
}
