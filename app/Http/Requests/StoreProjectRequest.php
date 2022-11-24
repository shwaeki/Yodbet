<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'address' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'hour_cost' => 'required|numeric',
            'manager_id' => 'required|exists:contacts,id',
            'client_id' => 'required|exists:clients,id',
        ];
    }
}
