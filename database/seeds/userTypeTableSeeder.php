<?php

use Illuminate\Database\Seeder;

class userTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            'name' => 'Alumno',
            'description' => NULL,
        ]);

        DB::table('user_types')->insert([
            'name' => 'Empleado',
            'description' => NULL,
        ]);

        DB::table('user_types')->insert([
            'name' => 'Caja',
            'description' => NULL,
        ]);

        DB::table('user_types')->insert([
            'name' => 'Escritor',
            'description' => NULL,
        ]);

        DB::table('user_types')->insert([
            'name' => 'Super Escritor',
            'description' => NULL,
        ]);

        DB::table('user_types')->insert([
            'name' => 'Administrador',
            'description' => NULL,
        ]);
    }
}
