<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommercialAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('building_id')->unsigned();
            $table->foreign('building_id')->references('id')->on('buildings');
            $table->string('image')->nullable();

            $table->boolean('activated')->default(1);
            $table->timestamps();
        });

        Schema::create('commercial_area_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('commercial_area_id')->unsigned();
            $table->string('name');
            $table->text('descr')->nullable();
            $table->char('locale', 3)->index();

            $table->unique(['commercial_area_id', 'locale']);
            $table->foreign('commercial_area_id')->references('id')->on('commercial_areas')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commercial_area_translations');
        Schema::dropIfExists('commercial_areas');
    }
}
