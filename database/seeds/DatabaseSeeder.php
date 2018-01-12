<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(EmailTableSeeder::class);
        $this->call(MarkTableSeeder::class);
        $this->call(ParametersTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(PermissionuserTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(WarehouseTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(StakeholderTableSeeder::class);
    }

}
