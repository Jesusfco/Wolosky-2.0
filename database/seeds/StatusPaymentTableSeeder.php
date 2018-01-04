<?php

use Illuminate\Database\Seeder;

class StatusPaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_payment')->insert([
            'name' => 'No pagado',            
        ]);

        DB::table('status_payment')->insert([
            'name' => 'Pagado',            
        ]);

        DB::table('status_payment')->insert([
            'name' => 'Modificado',            
        ]);

        DB::table('status_payment')->insert([
            'name' => 'Modificado/Pagado',            
        ]);

        DB::table('status_payment')->insert([
            'name' => 'Cancelado',            
        ]);

        DB::table('status_payment')->insert([
            'name' => 'Modificado/Cancelado',            
        ]);
    }
}
