<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = \App\User::all();
        foreach ($users as $user) {
        	$user->update(['api_token' => str_random(60)]);
        }
    }
}
