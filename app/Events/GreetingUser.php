<?php

namespace App\Events;

use App\Models\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GreetingUser implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    // ! Definimos las propiedades que se enviarán al canal
    private $user_id;
    public $greeting;

    public function __construct($user_id, $greeting) {
        $this->user_id  = $user_id;
        $this->greeting = $greeting;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array {
        return [
            new PrivateChannel('greeting-user.' . $this->user_id),
        ];
    }
}
