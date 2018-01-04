<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("departments")->insert([
            'description' => 'Department 1',
            'code' => '1',
        ]);
    }
}
