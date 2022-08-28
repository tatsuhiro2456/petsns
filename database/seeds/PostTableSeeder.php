<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params =
        [
            [
                'body' => '犬の名前はハチです',
                'image_path' => 'url.torakiti',
                'user_id' => '1'
                
            ],
            [
                'body' =>'猫の名前はトラキチです',
                'image_path' =>'url.torakiti',
                'user_id'=> '2'
            ],
            [
                'body' => '犬の名前はケンです',
                'image_path' => 'url.ken',
                'user_id' => '3'
            ]
        ];
        
        foreach ($params as $param) 
        {
            DB::table('posts')->insert($param);
        }
    }
}