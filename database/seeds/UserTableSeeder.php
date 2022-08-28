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
                'name' =>'ロイド・フォージャー',
                'email'=>'roid@mail.com',
                'age' =>'28',
                'image' =>'url.roid'
            ],
            [
                'name' =>'アーニャ・フォージャー',
                'email'=>'a-nya@mail.com',
                'age' =>'5',
                'image' =>'url.a-nya'
            ],
            [
                'name' =>'ヨル・フォージャー',
                'email'=>'yoru@mail.com',
                'age' =>'27',
                'image' =>'url.yoru'
            ]
        ];
        
        foreach ($params as $param) 
        {
            DB::table('users')->insert($param);
        }
    }
}