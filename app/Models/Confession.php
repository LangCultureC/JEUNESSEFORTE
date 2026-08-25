<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Confession extends Model
{
    protected $fillable = ['texte', 'categorie', 'auteur_id'];

    public function commentaires() { return $this->hasMany(Commentaire::class); }
    public function auteur() { return $this->belongsTo(User::class, 'auteur_id'); }
}
