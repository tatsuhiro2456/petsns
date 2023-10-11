<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Post_UserTableSeeder extends Seeder
{
    public function run()
    {
        $params =
        [
            [
                'post_id' => '1',
                'user_id' => '1'
            ],
            [
                'post_id' => '2',
                'user_id' => '2'
            ],
            [
                'post_id' => '3',
                'user_id' => '3'
            ]
        ];
        
        foreach ($params as $param) 
        {
            DB::table('post_user')->insert($param);
        }
    }
}