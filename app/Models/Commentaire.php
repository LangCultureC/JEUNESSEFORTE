<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $fillable = ['confession_id', 'texte', 'auteur_id', 'role_auteur'];

    public function confession() { return $this->belongsTo(Confession::class); }
    public function auteur() { return $this->belongsTo(User::class, 'auteur_id'); }
}
