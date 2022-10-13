<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'post.body' => 'required|string|max:200',
            'image_path' => 'required|file|max:25000|mimes:jpeg,png,jpg,mp4,mov',
        ];
    }
    public function messages()
    {
        return [
            'post.body.required' => '本文を記入してください。',
            'post.body.string' => '本文を200文字以内で記入してください。',
            'image_path.required' => 'ファイルを添付してください。',
            'image_path.max' => '25 MBを超えるファイルは添付できません。',
            'image_path.mimes' => '指定のファイル形式（jpeg,png,jpg,mp4,mov）以外は添付できません。',
        ];
    }
}
