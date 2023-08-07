<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RemainingTimeChanged implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // ? Agregamos propiedad pública
    public $time;
    
    // ? Agregamos constructor que recibe el tiempo
    public function __construct( $time ) {
        $this->time = $time;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array {
        // \Log::debug("Tiempo restante: {$this->time}");
        return [
            new Channel('ruleta'),
        ];
    }
}
