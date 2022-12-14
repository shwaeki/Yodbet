<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkerRequest extends FormRequest
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
            'phone1' => 'nullable|numeric',
            'phone2' => 'nullable|numeric',
            'hour_cost' => 'nullable|numeric',
            'identification' => 'nullable|numeric',
            'email' => 'nullable|email',
            'number' => 'nullable|numeric|unique:workers',
        ];
    }
}
