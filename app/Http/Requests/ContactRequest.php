<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'message' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'type' => 'required|in:complaint,suggestion,enquiry',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.nameIsRequired'),
            'message.required' => trans('validation.messageIsRequired'),
            'email.required' => trans('validation.emailIsRequired'),
            'email.email' => trans('validation.emailIsEmail'),
            'phone.required' => trans('validation.phoneIdIsRequired'),
            'phone.numeric' => trans('validation.phoneIsNumeric'),
            'type.required' => trans('validation.typeIsRequired'),
            'type.in' => trans('validation.typeIsIn'),
        ];
    }
}
