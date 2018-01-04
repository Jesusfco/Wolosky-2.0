<?php

use Illuminate\Database\Seeder;

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_type')->insert([
            'name' => 'Alumno/a',
            'description' => NULL,
        ]);

        DB::table('user_type')->insert([
            'name' => 'Maestro/a',
            'description' => NULL,
        ]);

        DB::table('user_type')->insert([
            'name' => 'Cajero/a',
            'description' => NULL,
        ]);

        DB::table('user_type')->insert([
            'name' => 'Escritor',
            'description' => NULL,
        ]);

        DB::table('user_type')->insert([
            'name' => 'Super Escritor',
            'description' => NULL,
        ]);

        DB::table('user_type')->insert([
            'name' => 'Administrador',
            'description' => NULL,
        ]);
    }
}
