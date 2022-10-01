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
                'image_path' => 'https://res.cloudinary.com/dgrrdt1vv/image/upload/v1664107258/neko_gydzat.jpg',
                'user_id' => '1'
                
            ],
            [
                'body' =>'猫の名前はトラキチです',
                'image_path' =>'https://res.cloudinary.com/dgrrdt1vv/image/upload/v1664107258/neko_gydzat.jpg',
                'user_id'=> '2'
            ],
            [
                'body' => '犬の名前はケンです',
                'image_path' => 'https://res.cloudinary.com/dgrrdt1vv/image/upload/v1664107258/neko_gydzat.jpg',
                'user_id' => '3'
            ]
        ];
        
        foreach ($params as $param) 
        {
            DB::table('posts')->insert($param);
        }
    }
}