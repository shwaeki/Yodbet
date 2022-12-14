<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'address' => 'nullable',
/*            'start_date' => 'required|date',
            'end_date' => 'required|date',*/
            'hour_cost' => 'required|numeric',
            'manager_id' => 'nullable|exists:contacts,id',
            'organizer_id' => 'nullable|exists:organizers,id',
        ];
    }
}
