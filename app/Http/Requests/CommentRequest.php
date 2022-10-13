<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'comment.body' => 'required|string|max:200',
        ];
    }
    public function messages()
    {
        return [
            'comment.body.required' => 'コメントを記入してください。',
            'comment.body.string' => 'コメントを200文字以内で記入してください。',
        ];
    }
}
