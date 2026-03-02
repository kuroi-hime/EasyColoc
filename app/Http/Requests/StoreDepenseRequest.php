<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_colocation' => 'required',
            'titre_depense' => 'required|string',
            'montant_depense' => 'required|numeric',
            'categorie_id' => 'nullable|integer',
            'nom_categorie' => 'nullable|string'
        ];
    }
}
