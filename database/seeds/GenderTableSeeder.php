<?php

use Illuminate\Database\Seeder;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gender')->insert([
            'name' => 'Masculino',            
        ]);

        DB::table('gender')->insert([
            'name' => 'Femenino',            
        ]);
    }
}
