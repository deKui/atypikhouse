<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'prenom' => 'required|string|max:255',
            'nom' => 'string|max:255',
            'avatar' => 'required|image|max:10240'
        ];
    }

    /**
     * Messages personnalisés 
     * @return [type] [description]
     */
    public function messages()
    {
        return [
            'avatar.max' => "L'image ne doit pas être supérieure à 10Mo.",
        ];
    }
}
