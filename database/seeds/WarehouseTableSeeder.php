<?php

use Illuminate\Database\Seeder;

class WarehouseTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("warehouses")->insert([
            'description' => 'tienda 1',
            'address' => 'direccion 1',
            'city_id' => 1,
        ]);
    }

}
