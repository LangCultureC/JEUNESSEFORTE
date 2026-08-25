<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageSalon extends Model
{
    protected $fillable = ['salon_id', 'auteur_id', 'texte'];

    public function auteur() { return $this->belongsTo(User::class, 'auteur_id'); }
}
