<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
{
    public function rules()
    {
        return [
            'pet.name' => 'required|string|max:100',
        ];
    }
    public function messages()
    {
        return [
            'pet.name.required' => '名前を記入してください。',
            'pet.name.string' => '名前を200文字以内で記入してください。',
        ];
    }
}
