<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
		$date = \Carbon\Carbon::now()->toDateTimeString();

        DB::table('roles')->delete();
        DB::table('roles')->insert(array(
            array("id" => 1, "name" => 'admin', 'created_at' => $date, 'updated_at' => $date),
            array("id" => 2, "name" => 'visitor', 'created_at' => $date, 'updated_at' => $date),
        ));

        DB::table('users')->delete();
        DB::table('users')->insert(array(
            array("id" => 1, "name" => 'romain', "password" => Hash::make('romain'), 'email' => 'romain@romain.com', 'created_at' => $date, 'updated_at' => $date),
        ));

        DB::table('role_user')->delete();
        DB::table('role_user')->insert(array(
            array("role_id" => 1, "user_id" => 1),
        ));

    }
}
