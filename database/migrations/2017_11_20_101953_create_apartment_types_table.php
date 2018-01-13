<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_types', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('order')->default(0);
        });

        Schema::create('apartment_type_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('apartment_type_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();

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
        Schema::dropIfExists('apartment_types');
    }
}
