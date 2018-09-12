<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'date_debut' => 'required|date_format:Y-m-d',
            'date_fin' => 'required|date_format:Y-m-d',
            'nb_personne' => 'required|integer',
        ];
    }
}
