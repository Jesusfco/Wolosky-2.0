<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Wolosky\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        factory(User::class, 150)->create();

//        $strings = array(
//            'Masculino',
//            'Femenino',
//        );
//        $key = array_rand($strings);
//
//        $phone = '';
//
//        for($i = 0; $i < 7; $i++) {
//            $phone .= mt_rand(0, 9);
//        }
//
        DB::table('users')->insert([
            'name' => 'JESUS FCO CORTES',
            'email' => 'jfcr@live.com',
            'password' => bcrypt('prueba'),
            'img' => NULL,
            'birthday' => Carbon::create('1995', '09', '23'),
            'gender' => 'M',
            'phone' => 9611221222,
            'street' => NULL,
            'hauseNumber' => NULL,
            'city' => 'Tuxtla Gtz',
            'colony' => NULL,
            'userTypeId' => 10,

        ]);
    }
}
