<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required','unique:users,username','min:3','max:20'],
            'password' => ['required','min:8','max:20'],
            'firstname' => ['required','min:3','max:20'],
            'lastname' => ['required','min:3','max:20'],
            'avatar' => ['required','mimes:jpg,jpeg','max:1024']
        ];
    }
}
