<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HabitatRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'titre' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|image|max:10000',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|regex:/\b\d{5}\b/',
            'ville' => 'required|string|max:255',
            'nb_lit_simple' => 'required|integer',
            'nb_lit_double' => 'required|integer',
            'nb_personne_max' => 'required|integer',
            'date_debut_dispo' => 'required|date_format:Y-m-d',
            'date_fin_dispo' => 'required|date_format:Y-m-d|after:date_debut_dispo',
            'prix' => 'required|integer',
        ];
    }

    /**
     * Messages personnalisés 
     * @return [type] [description]
     */
    public function messages()
    {
        return [
            'image.max' => "L'image ne doit pas être supérieure à 10Mo.",
        ];
    }
}
