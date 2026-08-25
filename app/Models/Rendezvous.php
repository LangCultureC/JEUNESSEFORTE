<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    protected $table = 'rendezvous'; // La vraie table s'appelle "rendezvous", pas "rendezvouses"

    protected $fillable = ['jeune_id', 'pro_id', 'motif', 'statut', 'date_heure'];

    public function jeune() { return $this->belongsTo(User::class, 'jeune_id'); }
    public function pro() { return $this->belongsTo(User::class, 'pro_id'); }
}
