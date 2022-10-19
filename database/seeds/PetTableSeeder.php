<?php

use Illuminate\Database\Seeder;

class PetTableSeeder extends Seeder
{
    public function run()
    {
        $params =
        [
            [
                'name' => 'dog1',
                'type' => 'dog',
                'image' => 'url.roidDog',
                'user_id' => '1'
                
            ],
            [
                'name' =>'cat1',
                'type' =>'cat',
                'image' =>'url.a-nyacat',
                'user_id'=> '2'
            ],
            [
                'name' => 'dog2',
                'type' => 'dog',
                'image' => 'url.yorudog',
                'user_id' => '3'
            ]
        ];
        
        foreach ($params as $param) 
        {
            DB::table('pets')->insert($param);
        }
    }
}