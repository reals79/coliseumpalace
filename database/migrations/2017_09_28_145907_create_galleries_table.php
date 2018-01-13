<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->longtext('images');
            $table->boolean('activated')->default(1);
            $table->tinyInteger('order')->default(0);
            $table->timestamps();
        });

        /*Schema::create('gallery_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gallery_id')->unsigned();
            $table->foreign('gallery_id')->references('id')->on('galleries');
            $table->string('image');
            $table->string('title')->nullable();
            $table->timestamps();
        });*/

        Schema::create('gallery_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('gallery_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['gallery_id', 'locale']);
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('gallery_images');
        Schema::dropIfExists('galleries');
    }
}
