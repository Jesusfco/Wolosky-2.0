<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'JESUS FCO CORTES',
            'email' => 'JFCR@LIVE.COM',
            'password' => bcrypt('secret'),
            'img' => NULL,
            'birthday' => Carbon::create('1995', '11', '22'),
            'gender' => 1,
            'phone' => 9611221222,
            'street' => NULL,
            'houseNumber' => NULL,
            'city' => 'Tuxtla Gtz',
            'colony' => NULL,
            'user_type_id' => 6,
            'status' => 1,
            'creator_user_id' => 1

        ]);

        DB::table('users')->insert([
            'name' => 'REBEKA WOLOSKY',
            'email' => 'WOLOSKYREBE@GMAIL.COM',
            'password' => bcrypt('shany'),
            'img' => NULL,
            'birthday' => Carbon::create('1995', '1', '23'),
            'gender' => 2,
            'phone' => NULL,
            'street' => NULL,
            'houseNumber' => NULL,
            'city' => 'Tuxtla Gtz',
            'colony' => NULL,
            'user_type_id' => 6,
            'status' => 1,
            'creator_user_id' => 1

        ]);

        // DB::table('users')->insert([
        //     'name' => 'ARTURO CORDERO',
        //     'email' => 'ARTURH.SW@GMAIL.COM',
        //     'password' => bcrypt('secret'),
        //     'img' => NULL,
        //     'birthday' => Carbon::create('1995', '1', '23'),
        //     'gender' => 1,
        //     'phone' => 9611221222,
        //     'street' => NULL,
        //     'houseNumber' => NULL,
        //     'city' => 'Tuxtla Gtz',
        //     'colony' => NULL,
        //     'user_type_id' => 6,
        //     'status' => 1,

        // ]);
    }
}
