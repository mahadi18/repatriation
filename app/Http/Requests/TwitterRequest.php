<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TwitterRequest extends Request
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
            'name'        => 'required',
            'sku'         => 'required|',
//            'sku'         => 'required|unique:tweets,sku,' . $this->get('id'),
//            'image'       => 'required|mimes:png'
        ];
    }
}
