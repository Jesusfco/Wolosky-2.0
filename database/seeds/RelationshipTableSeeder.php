<?php

use Illuminate\Database\Seeder;

class RelationshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         DB::table('relationship')->insert([
             'name' => 'Padre/Madre',             
         ]);
 
         DB::table('relationship')->insert([
             'name' => 'Hermano/a',
         ]);
 
         DB::table('relationship')->insert([
             'name' => 'Familiares',
         ]);
 
         DB::table('relationship')->insert([
             'name' => 'Amigos',
         ]);
 
         DB::table('relationship')->insert([
             'name' => 'Compañeros de trabajo',             
         ]);
 
         DB::table('relationship')->insert([
             'name' => 'Otro',             
         ]);
     }
}