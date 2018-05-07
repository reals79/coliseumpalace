<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('number', 15)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->float('total_amount_leasing');
            $table->float('total_amount_leasing_period');
            $table->float('total_amount_stavka');
            $table->float('total_amount_fine');
            $table->float('total_amount_pay');
            $table->float('total_amount_sold');
            $table->float('total_amount_debt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
