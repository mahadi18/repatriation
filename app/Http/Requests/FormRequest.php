<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FormRequest extends Request
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
            'form_attachment'   => 'max:1024|mimes:jpeg,jpg,gif,bmp,png,pdf,JPG',
            'date_of_action'            => 'date_format:d-m-Y|before:tomorrow',
            'date_of_acknowledgement'   => 'date_format:d-m-Y|before:tomorrow'
        ];
    }
}
