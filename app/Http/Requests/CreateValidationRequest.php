<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateValidationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'dateofbirth' => 'required|date',
            'age' => 'required|integer',
            'gender' => 'required|not_in:Select one',
            'civilstatus' => 'required|not_in:Select one',
            'nationality' => 'required',
            'contactnumber' => 'required',
            'streetaddress1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'valididtype1' => 'required|not_in:Select one',
            'validid1' => 'required',
        ];
    }
}
