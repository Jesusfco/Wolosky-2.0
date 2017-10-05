<?php

use Illuminate\Database\Seeder;

class salaryTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salary_types')->insert([
            'name' => 'Hora',
            'description' => NULL,
        ]);

        DB::table('salary_types')->insert([
            'name' => 'Día',
            'description' => NULL,
        ]);
    }
}
