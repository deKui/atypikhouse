<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RechercheRequest extends FormRequest
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
            'destination' => 'required|string|max:255',
            'voyageurs' => 'required|integer|max:50',
            'depart' => 'required|date_format:Y-m-d',
            'retour' => 'required|date_format:Y-m-d|after:depart',
        ];
    }
}
