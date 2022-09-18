<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::unique('users', 'email')->whereNull('deleted_at')],
            'password' => ['required'],
            'name'=>['required'],
            'birthday'=>['required','date'],
            'phone'=> ['sometimes','digits:11','starts_with:010,011,012,015'],
            'gender'=>['required']
        ];
    }
}
