<?php

use Illuminate\Database\Seeder;

class RecruitmentsTableSeeder extends Seeder
{
    public function run()
    {    
        $params =
        [
            [
                'user_id' => '1',
                'title' => '一緒に散歩しませんか',
                'body' => '渋谷ハチ公前18:00集合'
                
            ],
            [
                'user_id' => '3',
                'title' => '犬カフェ行きたい',
                'body' => '犬カフェ一緒に行く人募集'
            ],
            [
                'user_id' => '3',
                'title' => '犬ｍｐ散歩仲間募集',
                'body' => '大宮付近で募集しています'
            ]
        ];
        
        foreach ($params as $param) 
        {
            DB::table('recruitments')->insert($param);
        }
    }
}
