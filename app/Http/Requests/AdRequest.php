<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
            'image' => 'required|' . v_image(),
            'time_start' => 'required',
            'time_finish' => 'nullable',
            'product_id' => 'required|exists:products,id',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => trans('validation.imageIsRequired'),
            'image.image' => trans('validation.imageIsImage'),
            'image.mimes' => trans('validation.imageIsMimes'),
            'time_start.required' => trans('validation.timeStartIsRequired'),
            'time_finish.required' => trans('validation.timeFinishIsRequired'),
            'product_id.required' => trans('validation.productIdIsRequired'),
            'product_id.exists' => trans('validation.productIdIsExists'),
        ];
    }
}
