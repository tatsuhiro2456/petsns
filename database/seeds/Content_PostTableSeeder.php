<?php

use Illuminate\Database\Seeder;

class Content_PostTableSeeder extends Seeder
{
    public function run()
    {
        $params =
        [
            [
                'post_id' => '1',
                'content_id' => '1'
            ],
            [
                'post_id' => '2',
                'content_id' => '2'
            ],
            [
                'post_id' => '3',
                'content_id' => '3'
            ]
        ];
        
        foreach ($params as $param) 
        {
            DB::table('content_post')->insert($param);
        }
    }
}
