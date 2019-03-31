<?php

use App\City;
use App\User;
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
        $user = User::create([
	        'name' => 'XerK',
            'email' => 'gm.xerk@gmail.com',
            'password' => bcrypt('35604578'),
            'phone' => '201111981716',
        ]);
    }
}
