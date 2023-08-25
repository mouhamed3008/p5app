<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VenteConfectionUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'vente_id' => ['required', 'integer', 'exists:ventes,id'],
            'article_confection_id' => ['required', 'integer', 'exists:article_confections,id'],
        ];
    }
}
