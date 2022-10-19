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
            'pet.name.required' => 'コメントを記入してください。',
            'pet.name.string' => 'コメントを200文字以内で記入してください。',
        ];
    }
}
