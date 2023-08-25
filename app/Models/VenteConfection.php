<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VenteConfection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vente_id',
        'article_confection_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'vente_id' => 'integer',
        'article_confection_id' => 'integer',
    ];

    public function articleConfection(): BelongsTo
    {
        return $this->belongsTo(ArticleConfection::class);
    }

    public function articleVente(): BelongsTo
    {
        return $this->belongsTo(ArticleVente::class);
    }

    public function vente(): BelongsTo
    {
        return $this->belongsTo(ArticleVente::class);
    }


}
