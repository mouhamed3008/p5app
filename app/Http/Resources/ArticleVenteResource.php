<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleVenteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'libelle' => $this->libelle,
            'quantiteStock' => $this->quantiteStock,
            'prix' => $this->prix,
            'reference' => $this->reference,
            'photo' => $this->photo,
            'categorie_id' => $this->categorie_id,
        ];
    }
}
