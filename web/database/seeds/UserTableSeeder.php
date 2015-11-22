<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
        	'email' => 'martijn.simon.bakker@hotmail.com',
        	'password' => Hash::make('password')
        ));
    }

}