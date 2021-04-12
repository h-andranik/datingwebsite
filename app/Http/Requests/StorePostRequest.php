<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
                 'image' => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
                 'state' => 'max:1000',
                 'city' => 'max:1000',
                 'country' => 'max:100',
                 'age' => 'numeric|min:0|max:100',
        ];
    }
}
