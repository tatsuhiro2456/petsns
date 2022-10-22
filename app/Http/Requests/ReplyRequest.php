<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
{
    public function rules()
    {
        return [
            'reply.body' => 'required|string|max:200',
        ];
    }
    public function messages()
    {
        return [
            'reply.body.required' => '返信内容を記入してください。',
            'reply.body.string' => '返信内容を200文字以内で記入してください。',
        ];
    }
}