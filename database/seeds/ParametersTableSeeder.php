<?php

use Illuminate\Database\Seeder;

class ParametersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("parameters")->insert([
            'description' => "Camion",
            'value' => 10000,
            'group' => "type_vehicle",
            'code' => 1,
        ]);

        DB::table("parameters")->insert([
            'description' => "Camioneta",
            'value' => 8000,
            'group' => "type_vehicle",
            'code' => 2,
        ]);
    }

}
