<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $this->call(CashTableSeeder::class);
        // $this->call(DayTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(RelationshipTableSeeder::class);
        $this->call(SalaryTypeTableSeeder::class);
        $this->call(StatusPaymentTableSeeder::class);
        $this->call(StatusRecordTableSeeder::class);
        $this->call(StatusUserTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UserTypeTableSeeder::class);
        
    }
}
