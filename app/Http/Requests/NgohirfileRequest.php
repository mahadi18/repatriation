<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NgohirfileRequest extends Request
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
            'form_attachment'   => 'max:1024|mimes:jpeg,jpg,gif,bmp,png,pdf,JPG,PDF',
        ];
    }
}
