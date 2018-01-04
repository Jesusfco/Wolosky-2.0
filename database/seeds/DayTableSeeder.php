<?php

use Illuminate\Database\Seeder;

class DayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('day')->insert([
            'name' => 'Lunes',            
        ]);

        DB::table('day')->insert([
            'name' => 'Martes',            
        ]);

        DB::table('day')->insert([
            'name' => 'Miercoles',            
        ]);

        DB::table('day')->insert([
            'name' => 'Jueves',            
        ]);

        DB::table('day')->insert([
            'name' => 'Viernes',            
        ]);

        DB::table('day')->insert([
            'name' => 'Sabado',            
        ]);

        DB::table('day')->insert([
            'name' => 'Domingo',            
        ]);
    }
}
