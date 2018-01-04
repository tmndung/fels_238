<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WordlistRequest extends FormRequest
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
            'name' => 'required',
            'pronunciation' => 'required',
            'explain' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('lang.name_require'),
            'pronunciation:required' => trans('lang.pronunciation_require'),
            'explain.required' => trans('lang.explain_require'),
        ];
    }
}
