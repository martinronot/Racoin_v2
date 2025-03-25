<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SousCategorie extends Model
{
    protected $table = 'sous_categorie';
    protected $primaryKey = 'id_sous_categorie';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'description',
        'id_categorie'
    ];

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }

    public function annonces(): HasMany
    {
        return $this->hasMany(Annonce::class, 'id_sous_categorie');
    }
}
