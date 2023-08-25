<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleFournisseur extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fournisseur_id',
        'article_confection_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fournisseur_id' => 'integer',
        'article_confection_id' => 'integer',
    ];



    public function fournisseur(): BelongsTo
    {
        return $this->belongsTo(Fournisseur::class);
    }


    public function articleConfection(): BelongsTo
    {
        return $this->belongsTo(ArticleConfection::class);
    }
}
