<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('idno');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('contract', 15)->nullable();
            $table->timestamp('contract_at')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->float('total_amount_leasing');
            $table->float('total_amount_leasing_period');
            $table->float('total_amount_stavka');
            $table->float('total_amount_fine');
            $table->float('total_amount_pay');
            $table->float('total_amount_sold');
            $table->float('total_amount_debt');
            $table->boolean('activated')->default(0);
            $table->boolean('notify_is_email')->default(1);
            $table->boolean('notify_is_sms')->default(1);
            $table->rememberToken();
            $table->string('api_token',60)->unique()->nullable();
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
        Schema::dropIfExists('users');
    }
}
