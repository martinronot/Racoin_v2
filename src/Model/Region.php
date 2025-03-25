<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    protected $table = 'region';
    protected $primaryKey = 'id_region';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'code'
    ];

    public function departements(): HasMany
    {
        return $this->hasMany(Departement::class, 'id_region');
    }
}
