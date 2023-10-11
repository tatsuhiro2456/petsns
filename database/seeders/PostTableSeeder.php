<?php

namespace Database\Seeders;

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
                'image_path' => 'https://res.cloudinary.com/dgrrdt1vv/image/upload/v1667127529/fnl9i8eyq3nnns99g6d8.jpg',
                'user_id' => '1',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                
            ],
            [
                'body' =>'猫の名前はトラキチです',
                'image_path' =>'https://res.cloudinary.com/dgrrdt1vv/image/upload/v1667127541/ljbqroqeitbe2kg8hpem.jpg',
                'user_id'=> '2',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),       
            ],
            [
                'body' => '犬の名前はケンです',
                'image_path' => 'https://res.cloudinary.com/dgrrdt1vv/image/upload/v1667127503/ctefu9ee2z1oulm1p04v.jpg',
                'user_id' => '3',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ];
        
        foreach ($params as $param) 
        {
            DB::table('posts')->insert($param);
        }
    }
}