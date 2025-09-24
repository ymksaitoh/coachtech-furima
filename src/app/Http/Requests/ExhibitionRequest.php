<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'item_name' => 'required',
            'detail' => 'required|max:255',
            'item_img_file' => 'required|mimes:jpeg,png',
            'category' => 'required|array',
            'condition' => 'required',
            'price' => 'required|numeric|min:0',
        ];
    }
}
