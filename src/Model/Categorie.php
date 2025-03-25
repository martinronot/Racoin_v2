<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'id_categorie';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'description'
    ];

    public function sousCategories(): HasMany
    {
        return $this->hasMany(SousCategorie::class, 'id_categorie');
    }
}
