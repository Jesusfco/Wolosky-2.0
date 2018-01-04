<?php

use Illuminate\Database\Seeder;

class StatusUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_user')->insert([
            'name' => 'Validado',            
        ]);

        DB::table('status_user')->insert([
            'name' => 'No Verificado',            
        ]);

        DB::table('status_user')->insert([
            'name' => 'Baja temporal',            
        ]);

        DB::table('status_user')->insert([
            'name' => 'Baja',            
        ]);
    }
}
