<?php

namespace App\Events;

use App\Models\Confession;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConfessionSubmitted
{
    use Dispatchable, SerializesModels;

    public function __construct(public Confession $confession)
    {
    }
}
