<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->roles()->first()->role === 'admin' && Auth::check()) return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => ['required', 'min:3', 'max:50', 'string'],
            'product_image' => ['file', 'image', 'nullable'],
            'product_description' => ['nullable', 'string'],
//            'product_price' => ['required', 'numeric'],
            'is_offer' => ['required_with:offer_percent', 'ends_with:on,off'],
            'offer_percent' => ['required_with:is_offer', 'nullable', 'integer'],
            'product_count' => ['nullable', 'integer'],
            'category_id' => ['required', 'numeric'],
        ];
    }

}
