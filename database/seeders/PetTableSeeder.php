<?php

namespace Database\Seeders;

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
                'user_id' => '1'
                
            ],
            [
                'name' =>'cat1',
                'type' =>'cat',
                'user_id'=> '2'
            ],
            [
                'name' => 'dog2',
                'type' => 'dog',
                'user_id' => '3'
            ]
        ];
        
        foreach ($params as $param) 
        {
            DB::table('pets')->insert($param);
        }
    }
}