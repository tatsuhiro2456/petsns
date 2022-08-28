<?php

use Illuminate\Database\Seeder;

class ContentTableSeeder extends Seeder
{
     public function run(){
        $params =
        [
            [
                'type' => 'かわいい',
            ],
            [
                'type' =>'面白い',
            ],
            [
                'type' => 'ペット自慢',
            ]
        ];
        
        foreach ($params as $param) 
        {
            DB::table('contents')->insert($param);
        }
     }
}
