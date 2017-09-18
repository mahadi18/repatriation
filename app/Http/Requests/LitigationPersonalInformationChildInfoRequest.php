<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LitigationPersonalInformationChildInfoRequest extends Request
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
            'victim_child_name'             => 'required',
            'victim_child_date_of_birth'    => 'date_format:d-m-Y|before:tomorrow',
            'victim_child_sex'              => 'in:M,F,O',
        ];
    }
}
