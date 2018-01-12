<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("categories")->insert([
            'description' => 'Camion',
            'short_description' => 'Camiones',
            'order' => 1,
            'image' => ''
        ]);
        DB::table("categories")->insert([
            'description' => 'Camioneta',
            'short_description' => 'Camioneta',
            'order' => 2,
            'image' => ''
        ]);
        DB::table("categories")->insert([
            'description' => 'Automovil',
            'short_description' => 'Automovil',
            'order' => 3,
            'image' => ''
        ]);
    }

}
