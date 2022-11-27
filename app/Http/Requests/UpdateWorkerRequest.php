<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkerRequest extends FormRequest
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
            'name' => 'required',
            'phone1' => 'required|numeric|digits:10',
            'phone2' => 'nullable|numeric|digits:10',
            'hour_cost' => 'required|numeric',
            'identification' => 'required|numeric|digits:9',
            'email' => 'nullable|email',
        ];
    }
}
