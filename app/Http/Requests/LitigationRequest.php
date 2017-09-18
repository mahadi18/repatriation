<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class LitigationRequest extends Request {

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
            'name_during_rescue'	=> 'required',
            'nationality'	        => 'required|min:1',
            'rescue_date'			=> 'date_format:d-m-Y|before:tomorrow',
            'rescue_time'			=> 'date_format:h:i A',
            'gd_date'				=> 'date_format:d-m-Y|before:tomorrow',
            'fir_date'				=> 'date_format:d-m-Y|before:tomorrow'
		];
	}

}
