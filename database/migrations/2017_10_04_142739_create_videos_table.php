<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path')->nullable();
            $table->string('path_external')->nullable();
            $table->boolean('activated')->default(1);
            $table->tinyInteger('order')->default(0);
            $table->timestamps();
        });

        Schema::create('video_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('video_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['video_id', 'locale']);
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
