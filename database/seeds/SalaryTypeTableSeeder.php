<?php

use Illuminate\Database\Seeder;

class SalaryTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salary_type')->insert([
            'name' => 'Hora',
            'description' => NULL,
        ]);

        DB::table('salary_type')->insert([
            'name' => 'Día',
            'description' => NULL,
        ]);
    }
}
