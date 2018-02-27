<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('building_id')->unsigned();
            $table->foreign('building_id')->references('id')->on('buildings');
            $table->integer('apartment_type_id')->unsigned();
            $table->foreign('apartment_type_id')->references('id')->on('apartment_types');
            $table->string('number_apartment')->nullable();
            $table->string('floor')->nullable();
            $table->string('price')->nullable();
            $table->string('sold_apartment')->nullable();
            $table->integer('number_rooms')->unsigned()->nullable();
            $table->decimal('total_area', 4, 1)->unsigned()->nullable();
            $table->decimal('living_area', 4, 1)->unsigned()->nullable();
            $table->decimal('hall', 4, 1)->unsigned()->nullable();
            $table->decimal('living_room', 4, 1)->unsigned()->nullable();
            $table->decimal('kitchen', 4, 1)->unsigned()->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->decimal('wardrobe', 4, 1)->unsigned()->nullable();
            $table->decimal('terrace', 4, 1)->unsigned()->nullable();
            $table->string('image')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('activated')->default(1);
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
        Schema::dropIfExists('apartments');
    }
}
