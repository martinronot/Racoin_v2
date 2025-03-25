<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departement extends Model
{
    protected $table = 'departement';
    protected $primaryKey = 'id_departement';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'code',
        'id_region'
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'id_region');
    }

    public function annonces(): HasMany
    {
        return $this->hasMany(Annonce::class, 'id_departement');
    }
}
