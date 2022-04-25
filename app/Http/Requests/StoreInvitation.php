<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvitation extends FormRequest
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
            'email' => 'required|email|max:255|unique:user_invitations,email'
        ];
    }

    public function messages()
    {
        return [
            'email' => 'A valid email address must be provided',
            'email.unique' => 'An invite has already been sent for this email address'
        ];
    }
}
