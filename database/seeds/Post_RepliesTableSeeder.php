<?php

use Illuminate\Database\Seeder;

class Post_RepliesTableSeeder extends Seeder
{
    public function run()
    {
        $params =
        [
            [
                'body' =>'かわいいですね',
                'user_id' => '2',
                'post_id' => '1'
            ],
            [
                'body' =>'癒されます',
                'user_id' => '3',
                'post_id' => '1'
            ],
            [
                'body' =>'よろしくお願いします',
                'user_id' => '3',
                'post_id' => '2'
            ]
        ];
        
        foreach ($params as $param) 
        {
            DB::table('post_replies')->insert($param);
        }
    }
}
