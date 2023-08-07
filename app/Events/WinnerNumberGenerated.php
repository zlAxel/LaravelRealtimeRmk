<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WinnerNumberGenerated implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // ? Agregamos propiedad pública
    public $winnerNumber;
    
    // ? Agregamos constructor que recibe al ganador
    public function __construct( $winnerNumber ) {
        $this->winnerNumber = $winnerNumber;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array {
        // \Log::debug("WinnerNumberGenerated: {$this->winnerNumber}");
        return [
            new Channel('ruleta'),
        ];
    }
}
