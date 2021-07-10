<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterFormRequest extends FormRequest
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
            'name' => ['required' , 'alpha' , 'min:3' , 'max:100'],
            'password' => ['required' , 'max:10' , 'min:6', 'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/'],
            'email' => ['required' , 'string', 'email:rfc,dns' , 'unique:users,email'],
            'phone' => ['required' , 'string' , 'size:13']
        ];
    }

    protected function prepareForValidation()
    {
        $this->except(['_token']);
    }
}
