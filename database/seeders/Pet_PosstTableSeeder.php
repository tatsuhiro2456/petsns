<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Pet_PostTableSeeder extends Seeder
{
    public function run()
    {
        $params =
        [
            [
                'post_id' => '1',
                'pet_id' => '1'
            ],
            [
                'post_id' => '2',
                'pet_id' => '2'
            ],
            [
                'post_id' => '3',
                'pet_id' => '3'
            ]
        ];
        
        foreach ($params as $param) 
        {
            DB::table('pet_post')->insert($param);
        }
    }
}
