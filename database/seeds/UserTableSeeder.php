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

        factory(User::class, 150)->create();

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
//        DB::table('users')->insert([
//            'name' => str_random(10),
//            'email' => str_random(10).'@gmail.com',
//            'password' => bcrypt('secret'),
//            'img' => str_random(5),
//            'birthday' => Carbon::create('2000', '01', '01'),
//            'gender' => $key,
//            'phone' => 961 . $phone,
//            'street' => str_random(10),
//            'hauseNumber' => mt_rand(0, 1000),
//            'city' => 'Tuxtla Gtz',
//            'colony' => str_random(8),
//            'userTypeId' => mt_rand(1, 2),
//
//        ]);
    }
}
