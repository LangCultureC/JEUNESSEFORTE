<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;
use App\Models\SalonPrive;
use App\Models\MessageSalon;

class MessageSent implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public MessageSalon $message;

    public function __construct(MessageSalon $message)
    {
        $this->message = $message;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('salon.' . $this->message->salon_id);
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->message->id,
            'salon_id' => $this->message->salon_id,
            'auteur_id' => $this->message->auteur_id,
            'texte' => $this->message->texte,
            'created_at' => $this->message->created_at->toIso8601String(),
        ];
    }
}
