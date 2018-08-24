<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvisRequest extends FormRequest
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
            'comment' => 'required|string|min:1',
            'comment' => 'required|string|max:2000',
            'note' => 'required|int|min:1',
            'note' => 'required|int|max:5'
        ];
    }
}
