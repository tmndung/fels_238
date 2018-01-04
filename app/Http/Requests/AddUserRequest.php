<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'name' => 'required|max:50',
            'password' => 'required',
            'password-confirmation' => 'same:password',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('lang.usernameRequiredVali'),
            'name.max' => trans('lang.usernameMaxVali'),
            'password.required' => trans('lang.passwordRequired'),
            'password-confirmation.same' => trans('lang.passConfirmVali'),
            'email.required' => trans('lang.emailRequiredVali'),
            'email.email' => trans('lang.emailVali'),
        ];
    }
}
