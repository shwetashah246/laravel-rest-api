<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '*'     => 'bail',
            'name'  => 'required|max:50|alpha',
            'email' => 'required|email|max:255|unique:users,email',
            'age'   => 'required|integer|between:16,50',
            'address' => 'required|max:255'
        ];
    }
}
