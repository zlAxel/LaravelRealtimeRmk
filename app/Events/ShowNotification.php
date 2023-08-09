<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShowNotification implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // ! Creamos las propiedades de la notificación
    private int $user_id;
    public $data;

    /**
     * Create a new event instance.
     */
    public function __construct( int $user_id, $data ) {
        $this->user_id = $user_id;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array {
        return [
            new PrivateChannel('notifications.' . $this->user_id),
        ];
    }
}
