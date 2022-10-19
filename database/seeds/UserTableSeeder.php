<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params =
        [
            [
                'name' =>'ロイド',
                'email'=>'roid@mail.com',
                'password' => '11111111',
                'birthday' =>'1999/10/14',
                'image' =>'https://res.cloudinary.com/dgrrdt1vv/image/upload/v1666174531/ekvllbakoiwm2zwtbfuu.jpg'
            ],
            [
                'name' =>'ハリー',
                'email'=>'a-nya@mail.com',
                'password' => '22222222',
                'birthday' =>'2015/10/16',
                'image' =>'https://res.cloudinary.com/dgrrdt1vv/image/upload/v1666174531/ekvllbakoiwm2zwtbfuu.jpg'
            ],
            [
                'name' =>'加藤',
                'email'=>'yoru@mail.com',
                'password' => '33333333',
                'birthday' =>'2000/10/17',
                'image' =>'https://res.cloudinary.com/dgrrdt1vv/image/upload/v1666174531/ekvllbakoiwm2zwtbfuu.jpg'
            ]
        ];
        
        foreach ($params as $param) 
        {
            DB::table('users')->insert($param);
        }
    }
}