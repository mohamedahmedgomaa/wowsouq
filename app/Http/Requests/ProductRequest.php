<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'description' => 'required',
            'image' => 'required|' . v_image(),
            'files.*' => 'required|' . v_image(),
            'files' => 'required|array|max:4',
            'price' => 'required|numeric',
            'offer' => 'nullable|numeric',
            'category_id' => 'required|exists:categories,id',
            'seller_id' => 'required|exists:sellers,id',
            'number_product' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('validation.nameIsRequired'),
            'description.required' => trans('validation.descriptionIsRequired'),
            'image.required' => trans('validation.imageIsRequired'),
            'image.image' => trans('validation.imageIsImage'),
            'image.mimes' => trans('validation.imageIsMimes'),
            'files.required' => trans('validation.filesIsRequired'),
            'files.image' => trans('validation.filesIsImage'),
            'files.mimes' => trans('validation.filesIsMimes'),
            'price.required' => trans('validation.priceIsRequired'),
            'price.numeric' => trans('validation.priceIsNumeric'),
            'offer.numeric' => trans('validation.offerIsNumeric'),
            'category_id.required' => trans('validation.categoryIdIsRequired'),
            'seller_id.required' => trans('validation.sellerIdIsRequired'),
            'number_product.required' => trans('validation.numberProductIsRequired'),
        ];
    }
}
