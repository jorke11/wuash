<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("cities")->insert([
            'description' => 'Bogota',
            'department_id'=>1,
            'code'=>1
        ]);
    }

}
