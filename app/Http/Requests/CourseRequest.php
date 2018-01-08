<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'category_id' => 'required',
            'number_of_lesson' => 'required|integer|min:1',
            'information' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('lang.courseNameRequiredVali'),
            'category_id.required' => trans('lang.categoryIdRequiredVali'),
            'number_of_lesson.required' => trans('lang.totalLessonRequiredVali'),
            'number_of_lesson.integer' => trans('lang.totalLessonIntegerVali'),
            'number_of_lesson.min' => trans('lang.totalLessonMinVali'),
            'information.required' => trans('lang.informationRequiredVali'),
        ];
    }
}
