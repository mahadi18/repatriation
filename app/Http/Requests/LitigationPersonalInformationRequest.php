<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LitigationPersonalInformationRequest extends Request
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
            'full_name'             => 'required',
            'date_of_birth'         => 'date_format:d-m-Y|before:tomorrow',
            'sex'                   => 'in:M,F,O',
            'marital_status'        => 'in:S,M,D,W',
            'pregnancy'             => 'boolean',
        ];
    }
}
