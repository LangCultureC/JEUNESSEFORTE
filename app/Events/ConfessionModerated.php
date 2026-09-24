<?php

namespace App\Events;

use App\Models\Confession;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConfessionModerated
{
    use Dispatchable, SerializesModels;

    public function __construct(public Confession $confession, public bool $publiee)
    {
    }
}
