<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalonPrive extends Model
{
    protected $table = 'salon_prives';
    protected $fillable = ['jeune_id', 'pro_id', 'confession_id'];

    public function jeune() { return $this->belongsTo(User::class, 'jeune_id'); }
    public function pro() { return $this->belongsTo(User::class, 'pro_id'); }
    public function messages() { return $this->hasMany(MessageSalon::class, 'salon_id'); }
}
