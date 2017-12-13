<?php

use Illuminate\Database\Seeder;

class RelationshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         DB::table('relationships')->insert([
             'name' => 'Padre/Madre',             
         ]);
 
         DB::table('relationships')->insert([
             'name' => 'Hermano/a',
         ]);
 
         DB::table('relationships')->insert([
             'name' => 'Familiares',
         ]);
 
         DB::table('relationships')->insert([
             'name' => 'Amigos',
         ]);
 
         DB::table('relationships')->insert([
             'name' => 'Compañeros de trabajo',             
         ]);
 
         DB::table('relationships')->insert([
             'name' => 'Otro',             
         ]);
     }
