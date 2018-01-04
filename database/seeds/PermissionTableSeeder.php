<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("permissions")->insert([
            'typemenu_id' => 0,
            'parent_id' => 0,
            'description' => 'Module Home',
            'icon' => 'fa-home',
            'controller' => '',
            'priority' => 1,
            'title' => 'Home',
        ]);

        DB::table("permissions")->insert([
            'typemenu_id' => 0,
            'parent_id' => 0,
            'description' => 'Module security',
            'icon' => 'fa-unlock-alt',
            'controller' => '',
            'priority' => 2,
            'title' => 'security',
        ]);


        DB::table("permissions")->insert([
            'typemenu_id' => 0,
            'parent_id' => 0,
            'description' => 'Module Suller',
            'icon' => 'fa-home',
            'controller' => '',
            'priority' => 3,
            'title' => 'Sellers',
        ]);
    }

}
