<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CategoryFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->roles()->first()->role == 'admin' && Auth::check()) return true;

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
            'category_name' => ['required' , 'string' , 'min:2' , 'max:50'],
            'category_image' => ['nullable', 'image' , 'file'],
            'category_description' => ['nullable' , 'string'],
            'parent_category' => ['required', 'numeric'],
        ];
    }
}
