<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruitmentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'recruitment.title' => 'required|string|max:50',
            'recruitment.body' => 'required|string|max:200',
        ];
    }
    public function messages()
    {
        return [
            'recruitment.title.required' => 'タイトルを記入してください。',
            'recruitment.title.string' => 'タイトルを50文字以内で記入してください。',
            'recruitment.body.required' => '本文を記入してください。',
            'recruitment.body.string' => '本文を200文字以内で記入してください。',
        ];
    }
}
