<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleConfectionUpdateRequest extends FormRequest
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
            'libelle' => ['required', 'string', 'max:255'],
            'quantiteStock' => ['required', 'integer'],
            'prix' => ['required', 'numeric'],
            'reference' => ['required', 'string', 'max:255'],
            'photo' => ['required'],
            'categorie_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }
}
