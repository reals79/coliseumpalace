<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_id');
            $table->text('images')->nullable();
            $table->boolean('on_mainpage')->default(0);
            $table->boolean('footer')->default(0);
            $table->boolean('activated')->default(1);
            $table->tinyInteger('order')->default(0);
            $table->timestamps();
        });

        Schema::create('content_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('content_id')->unsigned();
            $table->string('name')->nullable();
            $table->longText('descr')->nullable();
            $table->string('locale')->index();

            $table->unique(['content_id', 'locale']);
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
