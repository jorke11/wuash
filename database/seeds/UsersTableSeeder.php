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
        DB::table("users")->insert([
            'name' => 'jorge',
            'last_name' => 'pined0',
            'email' => 'jpinedom@hotmail.com',
            'role_id' => 1,
            'city_id' => 1,
            'status_id' => 1,
            'document' => 1032323656,
            'password' => bcrypt('123')
        ]);
    }
}
