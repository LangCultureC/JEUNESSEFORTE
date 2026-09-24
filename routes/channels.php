<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Autorisées les connexions aux canaux privés
|--------------------------------------------------------------------------
*/

Broadcast::channel('salon.{salonId}', function ($user, $salonId) {
    $salon = \App\Models\SalonPrive::find($salonId);
    if (!$salon) {
        return false;
    }
    return $user->id === $salon->jeune_id || $user->id === $salon->pro_id;
});
