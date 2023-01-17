<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:55',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        if ($validator->fails()) :
            $response = [
                'status'    => false,
                'messages'  => $validator->errors(),
            ];

            throw new HttpResponseException(
                response()->json($response, 422)
            );
        endif;
    }
}
