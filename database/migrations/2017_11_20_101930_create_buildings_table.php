<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('order')->default(0);
        });

        Schema::create('building_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('building_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

            $table->unique(['building_id', 'locale']);
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buildings');
    }
}
