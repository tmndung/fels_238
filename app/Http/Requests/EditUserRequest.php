<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'email' => 'required|email',
            'facebook' => 'required|max:50',
            'twitter' => 'required|max:50',
            'description' => 'required',
            'password-confirmation' => 'same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('lang.usernameRequiredVali'),
            'name.max' => trans('lang.usernameMaxVali'),
            'email.required' => trans('lang.emailRequiredVali'),
            'email.email' => trans('lang.emailVali'),
            'facebook.required' => trans('lang.facebookRequiredVali'),
            'facebook.max' => trans('lang.facebookMaxVali'),
            'twitter.required' => trans('lang.twitterRequiredVali'),
            'twitter.max' => trans('lang.twitterMaxVali'),
            'description.required' => trans('lang.descriptionRequiredVali'),
            'password-confirmation.same' => trans('lang.passConfirmVali'),
        ];
    }
}
