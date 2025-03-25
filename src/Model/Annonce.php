<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Annonceur;
use App\Model\Photo;

class Annonce extends Model
{
    protected $table = 'annonce';
    protected $primaryKey = 'id_annonce';
    public $timestamps = false;

    protected $fillable = [
        'titre',
        'description',
        'prix',
        'date_publication',
        'id_annonceur'
    ];

    public function annonceur()
    {
        return $this->belongsTo(Annonceur::class, 'id_annonceur');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'id_annonce');
    }
}
