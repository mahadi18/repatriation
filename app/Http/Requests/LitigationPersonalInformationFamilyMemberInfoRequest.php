<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LitigationPersonalInformationFamilyMemberInfoRequest extends Request
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
            'family_member_name'    => 'required',
            'age'                   => 'numeric|between:0,100'
        ];
    }
}
