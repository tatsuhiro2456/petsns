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
                'image_path' => 'https://res.cloudinary.com/dgrrdt1vv/image/upload/v1666174510/ltpo0mkkcf5aeay0ugsy.jpg',
                'user_id' => '1',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                
            ],
            [
                'body' =>'猫の名前はトラキチです',
                'image_path' =>'https://res.cloudinary.com/dgrrdt1vv/image/upload/v1664107258/neko_gydzat.jpg',
                'user_id'=> '2',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),       
            ],
            [
                'body' => '犬の名前はケンです',
                'image_path' => 'https://res.cloudinary.com/dgrrdt1vv/image/upload/v1666174497/noisuoukdy5mbbpclcqu.jpg',
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