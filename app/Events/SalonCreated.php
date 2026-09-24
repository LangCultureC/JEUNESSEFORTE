<?php

namespace App\Events;

use App\Models\SalonPrive;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SalonCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(public SalonPrive $salon)
    {
    }
}
