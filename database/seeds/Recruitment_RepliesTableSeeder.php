<?php

use Illuminate\Database\Seeder;

class Recruitment_RepliesTableSeeder extends Seeder
{
    public function run()
    {
        $params =
        [
            [
                'body' =>'予定空いてるので行きます！',
                'user_id' => '2',
                'recruitment_id' => '1'
            ],
            [
                'body' =>'東京の犬カフェを予定しています',
                'user_id' => '3',
                'recruitment_id' => '2'
            ],
            [
                'body' =>'たまに向かわせていただきます！',
                'user_id' => '1',
                'recruitment_id' => '3'
            ]
        ];
        
        foreach ($params as $param) 
        {
            DB::table('recruitment_replies')->insert($param);
        }
    }
}
