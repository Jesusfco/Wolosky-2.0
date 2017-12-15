<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(CashTableSeeder::class);
        $this->call(salaryTypesTableSeeder::class);
        $this->call(userTypeTableSeeder::class);
        $this->call(RelationshipsTableSeeder::class);
    }
}
