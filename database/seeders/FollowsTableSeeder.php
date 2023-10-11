<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    public function run()
    {
        $params =
        [
            [
                'following_id' => '1',
                'followed_id' => '2'
            ],
            [
                'following_id' => '2',
                'followed_id' => '1'
            ],
            [
                'following_id' => '3',
                'followed_id' => '2'
            ]
        ];
        
        foreach ($params as $param) 
        {
            DB::table('follows')->insert($param);
        }
    }
}
